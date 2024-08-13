import React, { useEffect, useRef, useState } from 'react'
import ProductItem from '../Product/ProductItem'
import Tippy from '@tippyjs/react'
import 'tippy.js/dist/tippy.css'
import { Fetch, JSON } from 'sode-extend-react'
import ReactModal from 'react-modal'
import arrayJoin from '../../Utils/arrayJoin'


const customStyles = {
  content: {
    width: '400px',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    height: 'calc(100vh - 140px)'
  },
};

const OfferForm = ({ data, setData, refreshOffers }) => {

  let controller = new AbortController();

  const idRef = useRef()
  const nameRef = useRef()
  const priceRef = useRef()
  const offerRef = useRef()
  const dropdownRef = useRef()
  const searchRef = useRef()

  const [items, setItems] = useState([])
  const [results, setResults] = useState([])
  const [isOpen, setIsOpen] = useState(false)
  const [dropdownOpen, setDropdownOpen] = useState(false)

  const precioTotal = items.reduce((acc, item) => (Number(item.descuento) || 0) > 0 ? acc + Number(item.descuento) : acc + Number(item.precio), 0)

  useEffect(() => {
    if (data != null) setIsOpen(true)
    else setIsOpen(false)
    console.log('temrino de cargar')
  }, [data])

  const onFormSubmit = async (e) => {
    e.preventDefault()
    try {
      const { status, result } = await Fetch('/api/offers', {
        method: 'PATCH',
        body: JSON.stringify({
          id: idRef.current.value,
          producto: nameRef.current.value,
          precio: precioTotal,
          descuento: offerRef.current.value,
          parent_id: $('input[name="isParent"]:checked').val() ?? null,
          products: structuredClone(items).map(({ id }) => id)
        })
      })
      if (!status) throw new Error(result?.message ?? 'Ocurrio un error al guardar el combo')

      setIsOpen(false)
      setData(null)
      refreshOffers();
    } catch (error) {
      Swal.fire(
        '¡Error!',
        error.message,
        'error'
      )
    }
  }

  const onModalOpen = () => {
    idRef.current.value = data?.id ?? ''
    nameRef.current.value = data?.producto ?? ''
    offerRef.current.value = data?.descuento ?? 0
    priceRef.current.value = precioTotal ?? 0
    setItems(data?.products ?? [])
  }
  const onSearchChange = async () => {
    controller.abort('Nothing')

    const filter = [
      ['products.producto', 'contains', searchRef.current.value],
    ]
    if (items.length > 0) filter.push('and', [
      '!',
      arrayJoin(items.map(({ id }) => (['products.id', '=', id])))
    ])
    controller = new AbortController();
    const signal = controller.signal;
    const res = await fetch('/api/products/paginate', {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'X-Xsrf-Token': decodeURIComponent(Cookies.get('XSRF-TOKEN'))
      },
      body: JSON.stringify({
        filter
      }),
      signal
    })
    const result = JSON.parseable(await res.text())
    if (res.ok) setResults(result.data)
    else setResults([])
  }

  const onAddProduct = async (e, item) => {
    e.preventDefault()
    const newItems = structuredClone(items)
    newItems.push(item)
    setItems(newItems)
    searchRef.current.value = ''
    setDropdownOpen(false)
  }

  const onRemoveProduct = async (itemId) => {
    const newItems = structuredClone(items).filter(({ id }) => id != itemId)
    setItems(newItems)
  }

  return <ReactModal isOpen={isOpen} style={customStyles} onAfterOpen={onModalOpen} onRequestClose={() => setData(null)}>
    <form onSubmit={onFormSubmit}>
      <input type="hidden" name="id" ref={idRef} value={data?.id} />
      <div className='flex flex-row items-center justify-between gap-2 mb-2'>
        <h4 className='text-lg font-semibold'>{data?.id ? 'Actualizar combo' : 'Nuevo combo'}</h4>
        <div className='flex gap-1'>
          <button type="submit" className="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >
            <i className='fa fa-save'></i>
          </button>
          <button type="button" className="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" onClick={() => setIsOpen(false)}>
            <i className='fa fa-times'></i>
          </button>
        </div>
      </div>
      <div className="w-full grid grid-cols-2 gap-4">
        <div className='col-span-2'>
          <label htmlFor="offer-name" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del combo</label>
          <input ref={nameRef} type="text" id="offer-name" aria-describedby="helper-text-explanation" className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ej. Combo gamer" required />
        </div>
        <div>
          <label htmlFor="offer-precio" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio total</label>
          <input ref={priceRef} type="number" id="offer-precio" aria-describedby="helper-text-explanation" className="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" step={0.01} disabled value={precioTotal} required />
        </div>
        <div>
          <label htmlFor="offer-oferta" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio del combo</label>
          <Tippy content="Este precio se le cobrara al cliente al llevar el combo">
            <input ref={offerRef} type="number" id="offer-oferta" aria-describedby="helper-text-explanation" className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" step={0.01} required />
          </Tippy>
        </div>
      </div>
      <hr className='my-4' />
      <div className='relative flex flex-col items-center justify-between gap-2'>
        <h4 className='text-lg font-normal'>Lista de productos</h4>
        <button type="button" data-dropdown-toggle="dropdownResults" className="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-3 py-1 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" onClick={() => setDropdownOpen(!dropdownOpen)}>
          {dropdownOpen ? <i className='fa fa-times me-1'></i> : <i className=' fa fa-plus me-1'></i>}
          {dropdownOpen ? 'Ocultar' : 'Agregar'}
        </button>
        <div ref={dropdownRef} id="dropdownResults" className={`z-20 ${dropdownOpen ? 'block' : 'hidden'} absolute top-20 w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg dark:bg-gray-800 dark:divide-gray-700`} aria-labelledby="dropdownResultsButton" style={{ boxShadow: '0 0 10px rgba(0, 0, 0, .25)' }}>
          <div className="block p-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
            <input ref={searchRef} type="text" id="small-input" className="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder='Buscar producto' onChange={onSearchChange} />
          </div>
          <div className="divide-y divide-gray-100 dark:divide-gray-700">
            {results.length > 0 ? results.map((result, i) => <ProductItem key={`result-${i}`} {...result} onClick={onAddProduct} />) : <i className="block text-gray-400 m-2 max-w-max mx-auto">- No hay resultados -</i>}
          </div>
        </div>
        <div>
          {items.sort((a, b) => {
            return (b?.pivot?.isParent || 0) - (a?.pivot?.isParent || 0)
          }).map((item, i) => <ProductItem key={`item-${i}`} {...item} radioName='isParent' isParent={i == 0} onRemoveClicked={onRemoveProduct} />)}
        </div>
      </div>
    </form>
  </ReactModal>
}

export default OfferForm