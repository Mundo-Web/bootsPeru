import Tippy from '@tippyjs/react'
import React from 'react'

const ProductItem = ({ onClick = () => { }, onRemoveClicked, radioName = null, isParent = false, ...item }) => {
  const discountPrice = Number(item.descuento) || 0
  const originalPrice = Number(item.precio) || 0
  const price = discountPrice > 0 ? discountPrice : originalPrice
  return <a href='#' className={`flex items-center px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 w-full`} onClick={(e) => onClick(e, item)}>
    <div className="flex-shrink-0">
      <img className="rounded-md w-11 h-11" src={`/${item.imagen}`} alt="Robert image" onError={(e) => e.target.src = '/images/img/noimagen.jpg'} />
    </div>
    <div className="w-full ps-3">
      <div className="text-gray-500 text-sm mb-1.5 dark:text-gray-400 overflow-hidden" style={{ display: '-webkit-box', WebkitLineClamp: 2, textOverflow: 'ellipsis', WebkitBoxOrient: 'vertical', height: '40px' }}>
        {radioName && <Tippy content="Marcar como producto principal">
          <input className='mx-1 cursor-pointer' type="radio" name={radioName} defaultChecked={isParent} value={item.id} required />
        </Tippy>}
        <span className="font-semibold text-gray-900 dark:text-white" >
          {
            item.sku && <span class="bg-blue-100 text-blue-800 text-xs font-medium me-1 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{item.sku}</span>
          }
          {item.producto}</span> {item.description || <i className='text-gray-400'>- Sin Descripcion -</i>}</div>
      <div className="text-xs font-semibold text-blue-600 dark:text-blue-500">S/. {price.toFixed(2)}</div>
    </div>
    {onRemoveClicked && <div className="flex-shrink-0 ps-3">
      <i className='fa fa-trash cursor-pointer' onClick={() => onRemoveClicked(item.id)}></i>
    </div>}
  </a>
}

export default ProductItem