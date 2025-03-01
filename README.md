## Diagrama Base de Datos

<img src="diagrama-er.png">

## ENDPOINTS

| Método   | URL                                    | Descripción |
|----------|----------------------------------------|-------------|
| **POST** | `/api/register`                        | Registrar un nuevo usuario (Vendedor o Cliente) **Body:** `{ "name": "Jesus", "email": "jesus@vendedor.com", "password": "password", "tipo": "Vendedor" }` |
| **POST** | `/api/login`                           | Iniciar sesión **Body:** `{ "email": "jesus@vendedor.com", "password": "password" }` |
| **POST** | `/api/logout`                          | Cerrar sesión y eliminar Tokens de acceso |
| **GET**  | `/api/tiendas`                         | Visualizar todas las tiendas de un vendedor autenticado |
| **POST** | `/api/tiendas`                         | Crear una nueva tienda a un vendedor autenticado **Body:** `{ "nombre": "Tienda #1" }` |
| **GET**  | `/api/tiendas/{id}`                    | Mostrar información de una tienda |
| **PUT**  | `/api/tiendas/{id}`                    | Actualizar datos de una tienda **Body:** `{ "nombre": "Tienda #1 actualizada" }` |
| **DELETE** | `/api/tiendas/{id}`                  | Eliminar una tienda |
| **GET**  | `/api/productos`                       | Visualizar todos los productos de todas las tiendas del vendedor autenticado |
| **GET**  | `/api/productos?tienda={id}`           | Visualizar todos los productos de una tienda del vendedor autenticado |
| **POST** | `/api/productos`                       | Crear un nuevo producto para una tienda **Body:** `{ "nombre": "Cereal", "precio": 12.22, "stock": 10, "tienda_id": 1 }` |
| **PUT**  | `/api/productos/{id}`                  | Actualizar datos de un producto para una tienda **Body:** `{ "nombre": "Cereal Cuadrado", "precio": 10.00, "stock": 8, "tienda_id": 1 }` |
| **DELETE** | `/api/productos/{id}`                | Eliminar un producto |
| **GET**  | `/api/carrito`                         | Ver el carrito actual del cliente autenticado |
| **POST** | `/api/carrito/agregar`                 | Agregar producto al carrito actual del cliente autenticado **Body:** `{ "producto_id": 1, "cantidad": 3 }` |
| **POST** | `/api/carrito/eliminar`                | Quitar un producto del carrito actual del cliente autenticado **Body:** `{ "producto_id": 1 }` |
| **POST** | `/api/carrito/comprar`                 | Realizar la compra del carrito del cliente autenticado |
| **GET**  | `/api/compras`                         | Obtener el historial de compras del cliente autenticado |
