import React from "react"

const H1 = ({text,  children }) => {
  return <h1 className="h1">
    {children || text}
  </h1>
}

export default H1