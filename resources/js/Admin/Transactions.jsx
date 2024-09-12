import React, { useEffect, useRef, useState } from 'react';
import { createRoot } from 'react-dom/client';
import 'tippy.js/dist/tippy.css';
import TransactionsRest from '../actions/TransactionsRest';
import Table from '../components/Table';
import CreateReactScript from '../Utils/CreateReactScript';
import ReactAppend from '../Utils/ReactAppend';
import html2string from '../Utils/html2string';
import moment from 'moment-timezone';

const transactionsRest = new TransactionsRest()

const Transactions = () => {

  // moment.tz.setDefault('America/Lima')

  const gridRef = useRef();

  const [fromDate, setFromDate] = useState(new Date(new Date().getFullYear(), new Date().getMonth(), 1))
  const [toDate, setToDate] = useState(new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0))

  const formatDate = (date) => {
    return date.toISOString().split('T')[0];
  }

  useEffect(() => {
    const grid = $(gridRef.current).dxDataGrid('instance');
    if (grid) {
      const dateColumn = grid.columnOption('sale.created_at');
      if (dateColumn) {
        const adjustedFromDate = moment(fromDate).startOf('day');
        const adjustedToDate = moment(toDate).endOf('day');

        grid.columnOption('sale.created_at', {
          filterValue: [adjustedFromDate.toDate(), adjustedToDate.toDate()],
          filterType: 'between',
          selectedFilterOperation: 'between'
        });
      }
      grid.refresh();
    }
  }, [fromDate, toDate]);

  return (<>
    <Table gridRef={gridRef} rest={transactionsRest} exportable
      title={<div className='flex justify-between items-center'>
        <h3 className='font-semibold mb-3'>Movimientos</h3>
        <div className="grid grid-cols-1 md:grid-cols-2 md:gap-6 max-w-80 w-full mt-2">
          <div className="relative z-0 w-full group">
            <input type="date" name="floating_first_name" id="floating_first_name" className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " defaultValue={formatDate(fromDate)} required onChange={e => setFromDate(new Date(e.target.value))} />
            <label htmlFor="floating_first_name" className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Desde</label>
          </div>
          <div className="relative z-0 w-full group">
            <input type="date" name="floating_last_name" id="floating_last_name" className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " defaultValue={formatDate(toDate)} required onChange={e => setToDate(new Date(e.target.value))} />
            <label htmlFor="floating_last_name" className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Hasta</label>
          </div>
        </div>
      </div>}
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