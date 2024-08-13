import React from "react"

const ProductRow = ({id, producto, discount, price, onDeleteClicked}) => {
  return <tr>
    <td>{producto}</td>
    <td>S/. {discount > 0 ? discount.toFixed(2) : price.toFixed(2)} {discount > 0 && <span className='line-through'>{price.toFixed(2)}</span>}</td>
    <td>
      <button>Editar</button>
      <button onClick={() => onDeleteClicked(id)}>Eliminar</button>
    </td>
  </tr>
}

export default ProductRow