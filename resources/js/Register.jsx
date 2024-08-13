import { createRoot } from 'react-dom/client'
import React, { useEffect, useRef, useState } from 'react'
import JSEncrypt from 'jsencrypt'
import CreateReactScript from './Utils/CreateReactScript'
import AuthRest from './actions/AuthRest'
import ReCAPTCHA from 'react-google-recaptcha'
import { Link } from '@inertiajs/react'
import SelectFormGroup from './components/form/SelectFormGroup'
import InputFormGroup from './components/form/InputFormGroup'
import Modal from './components/Modal'
import HtmlContent from './Utils/HtmlContent'
import Swal from 'sweetalert2'

const Register = ({ PUBLIC_RSA_KEY, RECAPTCHA_SITE_KEY, token, terms = 'Terminos y condiciones', APP_URL }) => {

  document.title = 'Registro | Boost Peru Revendedores'

  const jsEncrypt = new JSEncrypt()
  jsEncrypt.setPublicKey(PUBLIC_RSA_KEY)
  console.log(PUBLIC_RSA_KEY)

  // Estados
  const [loading, setLoading] = useState(true)
  const [captchaValue, setCaptchaValue] = useState(null)
  const [found, setFound] = useState(false)

  const documentTypeRef = useRef()
  const documentNumberRef = useRef()
  const nameRef = useRef()
  const lastnameRef = useRef()
  const emailRef = useRef()
  const passwordRef = useRef()
  const confirmationRef = useRef()
  const termsRef = useRef()

  const termsModalRef = useRef();

  useEffect(() => {
    setLoading(false)
  }, [null])

  const onRegisterSubmit = async (e) => {
    e.preventDefault()
    setLoading(true)


    const password = passwordRef.current.value
    const confirmation = confirmationRef.current.value

    console.log(password)

    if (password != confirmation) {
      return Swal.fire({
        icon: 'warning',
        title: 'Error',
        text: 'Las contraseñas no coinciden',
        confirmButtonText: 'Ok'
      })
    }

    if (!captchaValue) return Swal.fire({
      icon: 'warning',
      title: 'Error',
      text: 'Por favor, complete el captcha',
      confirmButtonText: 'Ok'
    })

    // if (found) return Swal.fire({
    //   icon: 'warning',
    //   title: 'Error',
    //   text: 'El numero de documento ya esta registrado',
    //   confirmButtonText: 'Ok'
    // })

    const request = {
      document_type: $(documentTypeRef.current).val(),
      document_number: documentNumberRef.current.value,
      name: nameRef.current.value,
      lastname: lastnameRef.current.value,
      email: emailRef.current.value,
      password: jsEncrypt.encrypt(password),
      confirmation: jsEncrypt.encrypt(confirmation),
      terms: termsRef.current.checked,
      captcha: captchaValue,
      _token: token
    }
    console.log(request)
    const result = await AuthRest.signup(request)
    if (!result) return setLoading(false)

    if (result) location.href = `./confirm-email/${result}`;
    setLoading(false)
  }

  const onDocumentTypeChange = (e) => {
    documentNumberRef.current.value = ''
    setFound(false)
  }


  return (<>

    <div className="flex h-screen">

      <div className="basis-1/2 hidden md:block font-poppins">

        <div style={{ backgroundImage: `url(${APP_URL + '/images/imagen_login.png'})` }}
          className="bg-cover bg-center bg-no-repeat w-full h-full shadow-lg">

        </div>
      </div>
      <div className="w-full md:basis-1/2  text-[#151515] flex justify-center items-center font-Inter_Medium " style={{ marginTop: '260px' }}>
        <div className="w-5/6 flex flex-col gap-5 py-5">
          <div className="flex flex-col">


            <div className="text-center mb-4">
              <h4 className="text-uppercase mt-0 font-bold">Registrate</h4>
            </div>
            <form onSubmit={onRegisterSubmit} className='flex flex-col gap-4'>
              <div className="flex flex-col">
                <label htmlFor="document_type" className="form-label">Tipo documento <b className="text-danger">*</b></label>
                <select name="" id="" ref={documentTypeRef} onChange={onDocumentTypeChange} required>
                  <option value="DNI">DNI - Documento Nacional de Identidad</option>
                  <option value="CE">CE - Carnet de Extranjeria</option>
                </select>

              </div>
              <div className="flex flex-col">


                <input ref={documentNumberRef} className="font-Inter_Medium w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" type="text" id="document_number" placeholder="Ingrese su documento"
                  required />
              </div>
              <div className="grid grid-cols-4 gap-2">
                <div className="flex flex-col col-span-2">

                  <input ref={nameRef} className="font-Inter_Medium w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" type="text" id="name" placeholder="Ingrese su nombre"
                    required />
                </div>
                <div className="flex flex-col col-span-2">

                  <input ref={lastnameRef} className="font-Inter_Medium w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" type="text" id="lastname" placeholder="Ingrese sus apellidos"
                    required />
                </div>
              </div>

              <div className="flex flex-col">

                <input ref={emailRef} className="font-Inter_Medium w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" type="email" id="email" required
                  placeholder="Ingrese su correo electronico" />
              </div>
              <div className="flex flex-col">

                <input ref={passwordRef} className="font-Inter_Medium w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" type="password" required id="password"
                  placeholder="Ingrese su contraseña" />
              </div>
              <div className="flex flex-col">

                <input ref={confirmationRef} className="font-Inter_Medium w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" type="password" required id="confirmation"
                  placeholder="Confirme su contraseña" />
              </div>
              <div className="flex flex-col">
                <div className="form-check mx-auto" style={{ width: 'max-content' }}>
                  <input ref={termsRef} type="checkbox" className="form-check-input" id="checkbox-signup" required />
                  <label className="form-check-label" htmlFor="checkbox-signup">
                    Acepto los
                    <a
                      href="#terms" className="ms-1 text-blue" onClick={() => $(termsModalRef.current).modal('show')}>
                      terminos y condiciones
                    </a>
                  </label>
                </div>
              </div>
              <ReCAPTCHA className='m-auto mb-3' sitekey={RECAPTCHA_SITE_KEY} onChange={setCaptchaValue} style={{ display: "block", width: 'max-content' }} />
              <div className="mb-0 text-center d-grid">
                <button className="text-white bg-[#006BF6] w-full py-4 rounded-3xl cursor-pointer font-light font-Inter_Medium tracking-wide" type="submit" disabled={loading}>
                  {loading ? <>
                    <i className='fa fa-spinner fa-spin'></i> Verificando
                  </> : 'Registrarme'}
                </button>
              </div>
            </form>


            <div className="row mt-3">
              <div className="col-12 text-center">
                <p className="text-muted">Ya tienes una cuenta? <Link href="/login"
                  className="text-dark ms-1"><b>Iniciar sesion</b></Link></p>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>


  </>)
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Register {...properties} />);
})