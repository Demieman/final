import { createContext, useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';

export const ShoppingCartContext = createContext(null);

const ShoppingCartProvider = ({ children }) => {
  const [loading, setLoading] = useState(true);
  const [listOfProducts, setListOfProducts] = useState([]);
  const [productDetails, setProductDetails] = useState(null);
  const [cartItems, setCartItems] = useState([]);
  const navigate = useNavigate();

  const fetchData = async () => {
    try {
      const apiResponse = await fetch('https://dummyjson.com/products');
      const result = await apiResponse.json();

      if (result && result?.products) {
        setListOfProducts(result.products);
        setLoading(false);
      }
    } catch (error) {
      console.error('Error fetching list of products:', error);
    }
  };

  const handleAddToCart = (productDetails) => {
    // Implementation of adding product to cart
  };

  const handleRemoveFromCart = (productDetails, isFullyRemoveFromCart) => {
    // Implementation of removing product from cart
  };

  useEffect(() => {
    fetchData();
    setCartItems(JSON.parse(localStorage.getItem('cartItems') || '[]'));
  }, []);

  return (
    <ShoppingCartContext.Provider
      value={{
        listOfProducts,
        loading,
        setLoading,
        productDetails,
        setProductDetails,
        handleAddToCart,
        cartItems,
        handleRemoveFromCart,
      }}
    >
      {children}
    </ShoppingCartContext.Provider>
  );
};

export default ShoppingCartProvider;