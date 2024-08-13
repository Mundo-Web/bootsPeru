import React, { useEffect, useRef, useState } from 'react'
import { createRoot } from 'react-dom/client'
import CreateReactScript from '../Utils/CreateReactScript'
import OfferCard from '../components/Offer/OfferCard'
import Tippy from '@tippyjs/react'
import 'tippy.js/dist/tippy.css'
import OfferForm from '../components/Offer/OfferForm'
import Modal from 'react-modal';
import { Fetch } from 'sode-extend-react'
import ProductRow from '../components/Product/ProductRow'
import H1 from '../components/Product/H1'

Modal.setAppElement('body')

const Products = ({ products: productsFromDB = []}) => {
  
  const tableRef = useRef()
  const [products, setProducts] = useState(productsFromDB)
  const [productDeleted, setProductDeleted] = useState('Ningun producto borrado');

  useEffect(() => {
    // $(tableRef.current).dataTable()
    console.log('aqui deberia ejecutarse el datatable')
  }, [products])

  useEffect(() => {
    fetch('https://google.com')
  }, [null])

  const deleteProduct = () => {
    const copyProducts = structuredClone(products)
    const product = copyProducts.shift()
    setProductDeleted(`El producto ${product.producto} se ha eliminado`)
    setProducts(copyProducts)
  }
  
  const onProductRemove = (id) => {
    const copyProducts = structuredClone(products)
    const newProducts = copyProducts.filter(x => x.id != id)
    setProducts(newProducts)
  }

  return (<>
    <div className='p-6'>
      <button className='bg-blue-400 p-2 rounded-md' onClick={deleteProduct}>Eliminar primer registro</button>
      <H1 text={productDeleted}/>
      <table  ref={tableRef} className='table border w-full'>
        <thead>
          <tr>
            <td>Nombre</td>
            <td>Precio</td>
            <td>Acciones</td>
          </tr>
        </thead>
        <tbody>
          {
            products.length > 0 ? products.map(product => {
              const price = Number(product.precio) || 0
              const discount = Number(product.descuento) || 0
              return <ProductRow {...product} price={price} discount2={discount} onDeleteClicked={onProductRemove}/>
            }) : 'No hay productos'
          }
        </tbody>
      </table>
    </div>
  </>)
}

CreateReactScript((el, properties) => {
  createRoot(el).render(<Products {...properties} />);
})