import React from 'react'

const FilterPagination = ({ current, setCurrent, pages }) => {
  const array = new Array(pages || 1)
  array.fill(null)

  const onPrevPageClicked = () => {
    setCurrent(oldCurrent => oldCurrent <= 1 ? 1 : --oldCurrent);
  }

  const onNextPageClicked = () => {
    setCurrent(oldCurrent => oldCurrent >= pages ? pages : ++oldCurrent);
  }

  return (<>
    <nav aria-label="Page navigation example w-full">
      <ul className="flex flex-wrap items-center gap-1 -space-x-px text-base justify-center">
        <li>
          <button className="cursor-pointer disabled:[cursor:not-allowed] disabled:bg-transparent flex items-center justify-center px-4 h-10 w-10 leading-tight text-gray-500 disabled:hover:text-gray-500 hover:bg-white rounded-full bg-transparent hover:text-gray-700" onClick={onPrevPageClicked} type='button'
            disabled={current <= 1}>
            <span className="sr-only">Previous</span>
            <svg className="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 1 1 5l4 4" />
            </svg>
          </button>
        </li>
        {
          array.map((x, i) => {
            const index = i + 1
            if (index == current - 4 || index == current + 4) {
              return <li key={`item-${i}`}>
                <button aria-current="page" className='z-10 cursor-default flex items-center justify-center px-4 h-10 w-10 leading-tight rounded-full bg-transparent text-gray-500' type='button'>···</button>
              </li>
            }
            return <li key={`item-${i}`} className={index > current - 4 && index < current + 4 ? 'block' : 'hidden'}>
              <button aria-current="page" className={`cursor-pointer disabled:cursor-not-allowed z-10 bg-transparent text-gray-500 hover:text-gray-700 flex items-center justify-center px-4 h-10 w-10 leading-tight  hover:bg-white rounded-full ${current == index && '!bg-[#006BF6] !text-white !hover:bg-[#006bf6]'}`} onClick={() => setCurrent(index)} type='button' disabled={current == index}>{index}</button>
            </li>
          })
        }
        <li>
          <button className="cursor-pointer disabled:[cursor:not-allowed] disabled:bg-transparent flex items-center justify-center px-4 h-10 w-10 leading-tight text-gray-500 disabled:hover:text-gray-500 hover:bg-white rounded-full bg-transparent hover:text-gray-700" onClick={onNextPageClicked} type='button'
            disabled={current >= pages}>
            <span className="sr-only">Next</span>
            <svg className="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="m1 9 4-4-4-4" />
            </svg>
          </button>
        </li>
      </ul>
    </nav>
  </>)
}

export default FilterPagination