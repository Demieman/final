import { createRoot } from 'react-dom/client'
import App from './App.jsx'
import './index.css'
import { BrowserRouter } from 'react-router-dom'
import ShoppingCartProvider from './context/index.jsx'

const root = createRoot(document.getElementById('root'));
root.render(
  <BrowserRouter>
    <ShoppingCartProvider>
      <App />
    </ShoppingCartProvider>
  </BrowserRouter>
);