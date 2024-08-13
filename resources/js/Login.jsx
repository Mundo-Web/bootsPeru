import { createRoot } from 'react-dom/client'
import React, { useEffect, useRef, useState } from 'react'
import JSEncrypt from 'jsencrypt'
import CreateReactScript from './Utils/CreateReactScript'
import AuthRest from './actions/AuthRest'
import { Link } from '@inertiajs/react'
import Swal from 'sweetalert2'
import { GET } from 'sode-extend-react'

const Login = ({ PUBLIC_RSA_KEY, token, APP_DOMAIN, APP_PROTOCOL, APP_URL }) => {

  document.title = 'Login | Boost Peru Revendedores'

  const jsEncrypt = new JSEncrypt()
  jsEncrypt.setPublicKey(PUBLIC_RSA_KEY)

  // Estados
  const [loading, setLoading] = useState(true)

  const emailRef = useRef()
  const passwordRef = useRef()
  const rememberRef = useRef()

  useEffect(() => {
    if (GET.message) Swal.fire({
      icon: 'info',
      title: 'Mensaje',
      text: GET.message,
      showConfirmButton: false,
      timer: 3000
    })
    if (GET.service) history.pushState(null, null, `/login-rev?service=${GET.service}`)
    else history.pushState(null, null, '/login-rev')
  }, [null])

  const onLoginSubmit = async (e) => {
    e.preventDefault()
    setLoading(true)

    const email = emailRef.current.value
    const password = passwordRef.current.value

    const request = {
      email: jsEncrypt.encrypt(email),
      password: jsEncrypt.encrypt(password),
      _token: token
    }
    const result = await AuthRest.login(request)

    if (!result) return setLoading(false)

    if (GET.service) location.href = `${APP_PROTOCOL}://${GET.service}.${APP_DOMAIN}/home`;
    else location.href = './home';
  }

  return (
    <>
      <div className="flex h-screen">

        <div className="basis-1/2 hidden md:block font-poppins">

          <div style={{ backgroundImage: `url(${APP_URL + '/images/imagen_login.png'})` }}
            className="bg-cover bg-center bg-no-repeat w-full h-full shadow-lg">

          </div>
        </div>


        <div className="w-full md:basis-1/2  text-[#151515] flex justify-center items-center font-Inter_Medium">
          <div className="w-5/6 flex flex-col gap-5">
            <div className="flex flex-col gap-5 text-center md:text-left">
              {/* @if (session('status'))
            <div className="mb-4 font-medium text-sm text-green-600">
              {{ session('status') }}
            </div>
            @endif */}
              <h1 className="font-semibold font-Inter_Medium text-4xl tracking-tight">Iniciar Sesión</h1>
              <p className="font-normal text-base font-Inter_Medium tracking-tight">
                Inicie sesión utilizando los detalles de la cuenta a continuación.
              </p>
              <p className="font-normal text-base font-Inter_Medium tracking-tight">
                Especial para nuestros revendedoressss
              </p>
            </div>
            <div className="">
              <form onSubmit={onLoginSubmit} className="flex flex-col gap-5">

                <div>

                  <input ref={emailRef} className="font-Inter_Medium w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" type="email" id="email" required
                    placeholder="Tu nombre de usuario o correo electrónico" />


                </div>

                <div className="relative w-full">

                  <input type="password" placeholder="Contraseña" id="password" name="password" required
                    autoComplete="current-password"
                    className="font-Inter_Medium w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" />

                  <img src="./images/svg/pass_eyes.svg" alt="password"
                    className="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer" />
                </div>

                <div className="flex gap-3 px-4 justify-between">
                  <div>
                    <input type="checkbox" id="acepto_terminos" className="w-4" />
                    <label htmlFor="acepto_terminos" className="font-normal text-base font-Inter_Medium">Recuérdame
                    </label>
                  </div>

                  {/* @if (Route::has('password.request'))
                <div>
                  <a href="{{ route('password.request') }}" className="font-normal text-base font-Inter_Medium text-[#006BF6]">¿Olvidaste
                    tu contraseña?</a>
                </div>
                @endif */}

                </div>

                <div className="px-4">
                  <input type="submit" value="Iniciar Sesión"
                    className="text-white bg-[#006BF6] w-full py-4 rounded-3xl cursor-pointer font-light font-Inter_Medium tracking-wide" />
                </div>

                <div className="flex flex-row justify-center items-centerpx-4">
                  <a href="{{ route('register') }}"
                    className="text-[#006BF6] w-full py-2 rounded-3xl cursor-pointer font-light font-Inter_Medium tracking-normal text-center">Crear una Cuenta</a>
                </div>

              </form>
              {/* <x-validation-errors className="mt-4" /> */}
            </div>
          </div>
        </div>
      </div >
    </>
  )
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Login {...properties} />);
})