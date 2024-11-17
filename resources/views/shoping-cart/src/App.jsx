import { Fragment } from 'react';
import { Route, Routes } from 'react-router-dom';
import './App.css'
import ProductListPage from './page/productList';
import ProductDetailsPage from './page/productDetails';
import CartListPage from './page/cartList';

function App() {
  return (
    <Fragment>
      <Routes>
        <Route path='/products' element={<ProductListPage/>}/>
        <Route path='/product-details/:id' element={<ProductDetailsPage/>}/>
        <Route path='/cart' element={<CartListPage/>}/>
      </Routes>
    </Fragment>
    
  );
}

export default App