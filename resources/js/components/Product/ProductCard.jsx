import Tippy from '@tippyjs/react';
import React, { useState } from 'react';
import 'tippy.js/dist/tippy.css';

const ProductCard = ({ item, width, bgcolor, is_reseller }) => {
  const [showAmbiente, setShowAmbiente] = useState(false);
  const category = item.category;

  console.log('item', item)
  return (
    <div
      onMouseEnter={() => setShowAmbiente(true)}
      onMouseLeave={() => setShowAmbiente(false)}
      className={`flex flex-col relative w-full md:${width} ${bgcolor}`} data-aos="zoom-in-left"
    >
      <div className={`${bgcolor} product_container basis-4/5 flex flex-col justify-center relative`}>
        <div className="absolute top-2 left-2 w-max">
          {item.tags?.map((tag) => (
            <div className="px-4 mb-1" key={tag.id}>
              <span
                className="block font-semibold text-[8px] md:text-[12px] bg-black py-2 px-3 flex-initial w-full text-center text-white rounded-[5px] relative top-[18px] z-10"
                style={{ backgroundColor: tag.color }}
              >
                {tag.name}
              </span>
            </div>
          ))}
          {
            item.descuento > 0 && <div className="px-4 mb-1">
              <span
                className="block font-semibold text-[8px] md:text-[12px] bg-black py-2 px-3 flex-initial w-full text-center text-white rounded-[5px] relative top-[18px] z-10"
                style={{ backgroundColor: '#10c469' }}
              >
                -{Math.round(100 - ((item.descuento * 100) / item.precio))}%
              </span>
            </div>
          }
        </div>
        <div>
          <div className="relative flex justify-center items-center h-[300px]">
            <img
              style={{
                opacity: !item.imagen_ambiente || !showAmbiente ? '1' : '0',
                scale: !item.imagen_ambiente || !showAmbiente ? '1.05' : '1',
                backgroundColor: '#eeeeee'
              }}
              src={item.imagen ? `/${item.imagen}` : '/images/img/noimagen.jpg'}
              alt={item.name}
              onError={(e) => e.target.src = '/images/img/noimagen.jpg'}
              className={`transition ease-out duration-300 transform w-full h-[300px] object-${category.fit} absolute inset-0`}
            />

            {item.imagen_ambiente && (
              <img
                style={{
                  opacity: showAmbiente ? '1' : '0',
                  scale: showAmbiente ? '1.05' : '1'
                }}
                src={`/${item.imagen_ambiente}`}
                alt={item.name}
                onError={(e) => e.target.src = '/images/img/noimagen.jpg'}
                className="transition ease-out duration-300 transform w-full h-[300px] object-cover absolute inset-0"
              />
            )}
          </div>
          <div className="addProduct text-center flex justify-center h-0">
            <div className='flex flex-row gap-2 items-center'>
              <a
                href={`/producto/${item.id}`}
                className="font-semibold text-[16px] bg-[#006BF6] py-2 px-4 text-center text-white rounded-3xl h-10"
              >
                Ver producto
              </a>
              <Tippy content="Agregar al Carrito">
                <button href={`/producto/${item.id}`} type="button" id='btnAgregarCarrito'
                  data-id={`${item.id}`}
                  className="flex items-center font-semibold text-[13px] bg-[#006BF6] hover:bg-blue-400 py-1 px-4 text-center text-white rounded-3xl h-10">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="22" height="22" fill="#FFFFFF" ><path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20l44 0 0 44c0 11 9 20 20 20s20-9 20-20l0-44 44 0c11 0 20-9 20-20s-9-20-20-20l-44 0 0-44c0-11-9-20-20-20s-20 9-20 20l0 44-44 0c-11 0-20 9-20 20z" /></svg>

                </button>
              </Tippy>


            </div>

          </div>
        </div>
      </div>
      <a href={`/producto/${item.id}`} className='p-2'>
        <Tippy content={item.producto}>
          <h2 className="block text-[17px] text-center overflow-hidden" style={{ display: '-webkit-box', WebkitLineClamp: 2, textOverflow: 'ellipsis', WebkitBoxOrient: 'vertical', height: '51px' }}>
            {item.producto}
          </h2>
        </Tippy>

        {
          is_reseller ?
            (<>
              <div className="flex content-between flex-row gap-4 items-center justify-center">
                <span className="text-[#15294C] opacity-60 text-[16.45px]  line-through">S/. {item.descuento > 0 ? item.descuento : item.precio}</span>
                {item.descuento > 0 && (
                  <span className="text-sm text-[#15294C] opacity-60 line-through">S/. {item.precio}</span>
                )}
              </div>
              <div className="flex content-between flex-row gap-4 items-center justify-center">
                Reseller <span className="text-[#006BF6] text-[16.45px] font-bold">S/. {item.precio_reseller}</span>

              </div></>

            ) :
            (<div className="flex content-between flex-row gap-4 items-center justify-center">
              <span className="text-[#006BF6] text-[16.45px] font-bold">S/. {item.descuento > 0 ? item.descuento : item.precio}</span>
              {item.descuento > 0 && (
                <span className="text-sm text-[#15294C] opacity-60 line-through">S/. {item.precio}</span>
              )}
            </div>)
        }

      </a>


    </div>
  );
};

export default ProductCard;