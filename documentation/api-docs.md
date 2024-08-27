### API Documentation

#### Authentication

- **Login**
  - **URL:** `/login`
  - **Method:** `POST`
  - **Controller:** `AuthController@login`
  - **Description:** Authenticates a user and returns a token.
  - **Example Input:**
    ```json
    {
      "email": "user@example.com",
      "password": "password123"
    }
    ```
  - **Example Response:**
    ```json
    {
      "token": "your-auth-token"
    }
    ```

- **Register**
  - **URL:** `/register`
  - **Method:** [`POST`]
  - **Controller:** `AuthController@register`
  - **Description:** Registers a new user.
  - **Example Input:**
    ```json
    {
      "name": "John Doe",
      "email": "john@example.com",
      "password": "password123",
      "password_confirmation": "password123"
    }
    ```
  - **Example Response:**
    ```json
    {
      "message": "User registered successfully"
    }
    ```

#### Cart

- **Add to Cart**
  - **URL:** `/cart`
  - **Method:** [`POST`]
  - **Middleware:** [`auth:sanctum`]
  - **Controller:** `CartController@store`
  - **Description:** Adds an item to the cart.
  - **Example Input:**
    ```json
    {
      "product_id": 1,
      "quantity": 2
    }
    ```
  - **Example Response:**
    ```json
    {
      "message": "Item added to cart"
    }
    ```

- **Remove from Cart**
  - **URL:** `/cart/{id}`
  - **Method:** [`DELETE`]
  - **Middleware:** [`auth:sanctum`]
  - **Controller:** `CartController@destroy`
  - **Description:** Removes an item from the cart by ID.
  - **Example Response:**
    ```json
    {
      "message": "Item removed from cart"
    }
    ```

- **Clear Cart**
  - **URL:** `/cart`
  - **Method:** [`DELETE`]
  - **Middleware:** [`auth:sanctum`]
  - **Controller:** `CartController@clear`
  - **Description:** Clears all items from the cart.
  - **Example Response:**
    ```json
    {
      "message": "Cart cleared"
    }
    ```

#### Public Products

- **Search Products**
  - **URL:** `/products/search`
  - **Method:** [`GET`]
  - **Controller:** [`ProductController@search`]
  - **Description:** Searches for products.
  - **Example Input:**
    ```
    /products/search?query=laptop
    ```
  - **Example Response:**
    ```json
    {
      "products": [
        {
          "id": 1,
          "name": "Laptop",
          "slug": "laptop",
          "price": 1000
        }
      ]
    }
    ```

- **Show Product**
  - **URL:** `/products/{slug}`
  - **Method:** [`GET`]
  - **Controller:** [`ProductController@show`]
  - **Description:** Shows a product by slug.
  - **Example Response:**
    ```json
    {
      "id": 1,
      "name": "Laptop",
      "slug": "laptop",
      "price": 1000
    }
    ```

#### Admin Products 

- **List Products**
  - **URL:** `/admin/products`
  - **Method:** [`GET`]
  - **Controller:** [`AdminProductController@index`]
  - **Description:** Lists all products.
  - **Example Response:**
    ```json
    {
      "products": [
        {
          "id": 1,
          "name": "Laptop",
          "slug": "laptop",
          "price": 1000
        }
      ]
    }
    ```

- **Create Product**
  - **URL:** `/admin/products`
  - **Method:** [`POST`]
  - **Controller:** [`AdminProductController@store`]
  - **Description:** Creates a new product.
  - **Example Input:**
    ```json
    {
      "name": "Laptop",
      "slug": "laptop",
      "price": 1000
    }
    ```
  - **Example Response:**
    ```json
    {
      "message": "Product created successfully"
    }
    ```

- **Show Product**
  - **URL:** `/admin/products/{id}`
  - **Method:** [`GET`]
  - **Controller:** [`AdminProductController@show`]
  - **Description:** Shows a product by ID.
  - **Example Response:**
    ```json
    {
      "id": 1,
      "name": "Laptop",
      "slug": "laptop",
      "price": 1000
    }
    ```

- **Update Product**
  - **URL:** `/admin/products/{id}`
  - **Method:** [`PUT`]
  - **Controller:** [`AdminProductController@update`]
  - **Description:** Updates a product by ID.
  - **Example Input:**
    ```json
    {
      "name": "Laptop",
      "slug": "laptop",
      "price": 1200
    }
    ```
  - **Example Response:**
    ```json
    {
      "message": "Product updated successfully"
    }
    ```

- **Delete Product**
  - **URL:** `/admin/products/{id}`
  - **Method:** [`DELETE`]
  - **Controller:** [`AdminProductController@destroy`]
  - **Description:** Deletes a product by ID.
  - **Example Response:**
    ```json
    {
      "message": "Product deleted successfully"
    }
    ```
