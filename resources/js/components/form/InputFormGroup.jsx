import React from "react"

const InputFormGroup = ({ clasName, label, eRef, type = 'text', placeholder, required = false, disabled = false, value, step, onChange = () => { } }) => {
  return <div className={` ${clasName} mb-2 `}>
    <label htmlFor=''>
      {label} {required && <b className="text-danger">*</b>}
    </label>
    <input ref={eRef} type={type} className='form-control' placeholder={placeholder} required={required} disabled={disabled} defaultValue={value ?? ''} step={step} onChange={onChange} />
  </div>
}

export default InputFormGroup