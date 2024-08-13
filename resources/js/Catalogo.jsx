import React, { useEffect, useState, useRef } from 'react'
import { createRoot } from 'react-dom/client'
import CreateReactScript from './Utils/CreateReactScript'
import FilterContainer from './components/Filter/FilterContainer'
import ProductContainer from './components/Product/ProductContainer'
import { Fetch } from 'sode-extend-react'
import FilterPagination from './components/Filter/FilterPagination'
import arrayJoin from './Utils/ArrayJoin'
import ProductCard from './components/Product/ProductCard'
import { set } from 'sode-extend-react/sources/cookies'




const Catalogo = ({ minPrice, maxPrice, categories, tags, attribute_values, id_cat: selected_category, tag_id, subCatId }) => {
  const take = 12
  useEffect(() => {
    const script = document.createElement('script');
    script.src = "https://cdn.sode.me/extends/notify.extend.min.js";
    script.async = true;
    document.body.appendChild(script);

    return () => {
      document.body.removeChild(script);
    };
  }, [null]);

  const [items, setItems] = useState([])
  const [filter, setFilter] = useState(selected_category ? { category_id: [selected_category] } : { 'txp.tag_id': [tag_id] })
  const [totalCount, setTotalCount] = useState(0)
  const [currentPage, setCurrentPage] = useState(1)

  const [showModal, setShowModal] = useState(false)
  const is_proveedor = useRef(false);



  useEffect(() => {
    if (subCatId !== null) {
      setFilter({ ...filter, subcategory_id: [subCatId] })
    }
  }, [])

  useEffect(() => {
    setCurrentPage(1)
    getItems()
  }, [filter])

  useEffect(() => {
    getItems()
  }, [currentPage])

  const getItems = async () => {
    const filterBody = []

    if (filter.maxPrice || filter.minPrice) {
      if (filter.maxPrice && filter.minPrice) {
        filterBody.push([
          [
            ['precio', '>=', filter.minPrice],
            'or',
            ['descuento', '>=', filter.minPrice]
          ],
          'and',
          [
            ['precio', '<=', filter.maxPrice],
            'or',
            ['descuento', '<=', filter.maxPrice]
          ]
        ])
      } else if (filter.minPrice) {
        filterBody.push([
          ['precio', '>=', filter.minPrice],
          'or',
          ['descuento', '>=', filter.minPrice]
        ])
      } else if (filter.maxPrice) {
        filterBody.push([
          ['precio', '<=', filter.maxPrice],
          'or',
          ['descuento', '<=', filter.maxPrice]
        ])
      }
    }


    if (filter['txp.tag_id'] && filter['txp.tag_id'].length > 0) {
      const tagsFilter = []
      filter['txp.tag_id'].forEach((x, i) => {
        if (i == 0) {
          tagsFilter.push(['txp.tag_id', '=', x])
        } else {
          tagsFilter.push('or', ['txp.tag_id', '=', x])
        }
      })
      filterBody.push(tagsFilter)
    }

    for (const key in filter) {
      if (!key.startsWith('attribute-')) continue
      if (filter[key].length == 0) continue
      const [, attribute_id] = key.split('-')
      const attributeFilter = []
      filter[key].forEach((x, i) => {
        if (i == 0) {
          attributeFilter.push(['apv.attribute_value_id', '=', x])
        } else {
          attributeFilter.push('or', ['apv.attribute_value_id', '=', x])
        }
      })
      filterBody.push([
        ['a.id', '=', attribute_id],
        'and',
        attributeFilter
      ])
    }

    if (filter['category_id'] && filter['category_id'].length > 0) {
      const categoryFilter = []
      filter['category_id'].forEach((x, i) => {
        if (i == 0) {
          categoryFilter.push(['categoria_id', '=', x])
        } else {
          categoryFilter.push('or', ['categoria_id', '=', x])
        }
      })
      filterBody.push(categoryFilter)
    }


    if (filter['subcategory_id'] && filter['subcategory_id'].length > 0) {
      const subcategoryFilter = []
      filter['subcategory_id'].forEach((x, i) => {
        if (i == 0) {
          subcategoryFilter.push(['subcategory_id', '=', x])
        } else {
          subcategoryFilter.push('or', ['subcategory_id', '=', x])
        }
      })
      filterBody.push(subcategoryFilter)
    }

    const { status, result } = await Fetch('/api/products/paginate', {
      method: 'POST',
      body: JSON.stringify({
        requireTotalCount: true,
        filter: arrayJoin([...filterBody, ['products.visible', '=', true]], 'and'),
        take,
        skip: take * (currentPage - 1)
      })
    })
    console.log('result', result)
    is_proveedor.current = result?.is_proveedor ?? false
    console.log('is_proveedor', is_proveedor.current)
    setItems(result?.data ?? [])
    setTotalCount(result?.totalCount ?? 0)
  }

  const attributes = attribute_values.reduce((acc, item) => {
    // If the attribute_id does not exist in the accumulator, create a new array for it
    if (!acc[item.attribute_id]) {
      acc[item.attribute_id] = [];
    }
    // Add the current item to the array corresponding to its attribute_id
    acc[item.attribute_id].push(item);
    return acc;
  }, {});

  return (<>
    <style>

    </style>
    <form className="flex flex-col md:flex-row gap-6  mx-auto font-poppins bg-[#F1F1F1] w-full" style={{ padding: '40px' }}>
      <section className="hidden md:flex md:flex-col gap-4 md:basis-3/12 bg-white p-6 rounded-lg h-max md:sticky top-2">
        <FilterContainer setFilter={setFilter} filter={filter} minPrice={minPrice ?? 0} maxPrice={maxPrice ?? 0} categories={categories} tags={tags} attribute_values={Object.values(attributes)} selected_category={selected_category} tag_id={tag_id} />
      </section>
      <section className="flex flex-col gap-6 md:basis-9/12">
        <div className="w-full bg-white rounded-lg font-medium flex flex-row justify-between items-center px-2 py-3">
          <div className='flex flex-row gap-2'>
            <span className="font-normal text-[17px] text-[#666666] ml-3">
              Mostrando {((currentPage - 1) * take) + 1} - {currentPage * take > totalCount ? totalCount : currentPage * take} de {totalCount} resultados
            </span>
            <button type="button" className='md:hidden text-[#006BF6]' onClick={() => setShowModal(true)}> Mostrar Filtros</button>
          </div>
        </div>
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:pr-4">
          {items.map((item, i) => <ProductCard key={`product-${item.id}`} item={item} bgcolor={'bg-white'} is_reseller={is_proveedor.current} />)}
        </div>
        <div className="w-full font-medium flex flex-row justify-center items-center">
          <FilterPagination current={currentPage} setCurrent={setCurrentPage} pages={Math.ceil(totalCount / take)} />
        </div>
      </section>
      {/* modal */}

      {showModal && (<div className="fixed z-40 top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center max-h-[80vh] " id="modal">
        {/* btn para cerrar modal */}
        <div className="z-50 flex items-center content-center justify-center absolute  p-4 bg-black rounded-full h-6 w-6" style={{ top: '20px', right: '20px' }}>
          <button type='button' onClick={() => setShowModal(false)} className="text-white text-md ">X</button>

        </div>

        <div className='flex flex-col gap-4 md:basis-3/12 bg-white p-6 rounded-lg top-2 overflow-y-auto mt-10' style={{ maxHeight: '90vh', maxWidth: "85vh" }}>
          <FilterContainer setFilter={setFilter} filter={filter} minPrice={minPrice ?? 0} maxPrice={maxPrice ?? 0} categories={categories} tags={tags} attribute_values={Object.values(attributes)} selected_category={selected_category} tag_id={tag_id} />
        </div>

      </div>)}


    </form>
  </>)
}

CreateReactScript((el, properties) => {
  createRoot(el).render(<Catalogo {...properties} />);
})