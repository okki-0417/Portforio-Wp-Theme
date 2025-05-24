import React from 'react'
import ReactDOM from 'react-dom/client'

const App = () => <h1>Hello from React + TypeScript!</h1>

const root = document.getElementById('my-react-root')
if (root) {
  ReactDOM.createRoot(root).render(<App />)
}
