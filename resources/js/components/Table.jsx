import React from 'react'
import DataGrid from './DataGrid'

const Table = ({ title, gridRef, rest, columns, toolBar, masterDetail, filterValue = [], exportable = false, customizeCell }) => {
  return (<div className="flex flex-wrap">
    <div className="w-full px-4 sm:px-6 lg:px-8 py-8 max-w-9xl mx-auto">
      <div className="bg-white rounded-lg shadow-md">
        <div className="p-4">
          <h4 className="text-lg font-semibold mb-4">
            <div id="header-title-options" className="float-right"></div>
            <span id="header-title-prefix"></span> Lista de {title} <span id="header-title-suffix"></span>
          </h4>
          <DataGrid
            exportableName={title}
            gridRef={gridRef}
            rest={rest}
            columns={columns.filter(Boolean)}
            toolBar={toolBar}
            masterDetail={masterDetail}
            filterValue={filterValue}
            exportable={exportable}
            customizeCell={customizeCell}
          />
        </div>
      </div>
    </div>
  </div>)
}

export default Table