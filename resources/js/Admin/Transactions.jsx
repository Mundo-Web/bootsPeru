import React, { useRef } from 'react';
import { createRoot } from 'react-dom/client';
import Modal from 'react-modal';
import 'tippy.js/dist/tippy.css';
import TransactionsRest from '../actions/TransactionsRest';
import Table from '../components/Table';
import CreateReactScript from '../Utils/CreateReactScript';
import ReactAppend from '../Utils/ReactAppend';
import html2string from '../Utils/html2string';
import DxButton from '../components/dx/DxButton';

const transactionsRest = new TransactionsRest()

const Transactions = () => {

  const gridRef = useRef();

  return (<>
    <Table gridRef={gridRef} title='Movimientos' rest={transactionsRest} exportable
      toolBar={(container) => {
        container.unshift({
          widget: 'dxButton', location: 'after',
          options: {
            icon: 'refresh',
            hint: 'Refrescar tabla',
            onClick: () => $(gridRef.current).dxDataGrid('instance').refresh()
          }
        });
      }}
      columns={[
        {
          dataField: 'sale.code',
          caption: 'Codigo'
        },
        {
          dataField: 'sale.status.name',
          caption: 'Estado'
        },
        {
          dataField: 'sale.name',
          caption: 'Nombre',
          cellTemplate: (container, { data }) => {
            container.html(`${data.sale.name}<br>${data.sale.lastname || ''}`.trim())
          }
        },
        {
          dataField: 'sale.address_district',
          caption: 'Distrito',
          cellTemplate: (container, { data }) => {
            container.html(data.sale.address_district || '<i>- Sin distrito -</i>')
          }
        },
        {
          dataField: 'category',
          caption: 'Categoria',
        },
        {
          dataField: 'image',
          caption: 'Imagen',
          width: '90px',
          cellTemplate: (container, { data }) => {
            ReactAppend(container, <img src={`/${data.product_image}`} style={{ width: '80px', height: '48px', objectFit: 'cover', objectPosition: 'center', borderRadius: '4px' }} onError={e => e.target.src = '/images/img/noimagen.jpg'} />)
          },
          allowExporting: false
        },
        {
          dataField: 'product_name',
          caption: 'Producto',
          cellTemplate: (container, { data }) => {
            container.html(data.product_name)
          }
        },
        {
          dataField: 'quantity',
          caption: '#',
          dataType: 'number'
        },
        {
          dataField: 'price',
          caption: 'Precio',
          dataType: 'number',
          cellTemplate: (container, { data }) => {
            container.text(`S/.${Number(data.price).toFixed(2)}`)
          }
        },
        {
          dataField: 'sale.created_at',
          caption: 'Fecha',
          dataType: 'datetime',
          format: 'yyyy-MM-dd HH:mm:ss',
          sortOrder: 'desc'
        },
        {
          caption: 'Acciones',
          cellTemplate: (container, { data }) => {
            container.append(DxButton({
              className: 'px-2 py-0 text-xs font-medium text-blue-700 bg-blue-100 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out border-none text-blue-500',
              title: 'Ver venta',
              icon: 'fa fa-eye',
              onClick: () => location.href = '/admin/'
            }))
          },
          allowFiltering: false,
          allowExporting: false
        }
      ]}
      customizeCell={(options) => {
        if (options?.gridCell?.rowType == 'data' && !options?.gridCell?.value) {
          if (options.gridCell.column.dataField === 'sale.address_district') {
            options.excelCell.value = '- Sin distrito -'
            options.excelCell.font = { italic: true }
          }
        } else if (options?.gridCell?.rowType == 'data' && options.gridCell.column.dataField === 'product_name') {
          options.excelCell.value = html2string(
            options.excelCell.value
              .replaceAll('</b><ul', '</b>\n<ul')
              .replaceAll('</li><li', '</li>\n<li')
          )
          options.excelCell.alignment = {
            wrapText: true
          }
        } else if (options?.gridCell?.rowType == 'data' && options.gridCell.column.dataField === 'price') {
          options.excelCell.numFmt = '0.00';
          options.excelCell.alignment = {
            horizontal: 'right'
          }
        } else if (options?.gridCell?.rowType == 'data' && options.gridCell.column.dataField === 'sale.name') {
          options.excelCell.value = `${options.gridCell.data.sale.name} ${options.gridCell.data.sale.lastname}`
        }
      }}
    />
  </>)
}

CreateReactScript((el, properties) => {
  createRoot(el).render(<Transactions {...properties} />);
})