Ada 5 method request HTTP yang sangat umum digunakan pada arsitektur
REST ini, yaitu :

GET  
Digunakan untuk mengakses data atau membaca data yang ada
pada resource.

POST  
Digunakan untuk men-create atau membuat sebuah resource
baru.

PUT  
Digunakan untuk memperbaharui sebuah resource, atau
menambahnya.

PATCH  
Digunakan untuk mengupdate kumpulan data (field) yang ada di
dalam resource secara partial.

DELETE  
Digunakan untuk menghapus resource.

Pada kegiatan codelab kalo ini kita akan melakukan sebuah interaksi dengan MySQL Database menggunakan PHP, dan kita akan membuat 4 Endpoint REST API yang dapat melakukan aksi Create, Read, Update, Delete. <br>
Rincian endpoint yang kita buat adalah sebagai berikut:

GET http://127.0.0.1:8000/api/product  
GET http://127.0.0.1:8000/api/product/{id}  
POST http://127.0.0.1:8000/api/product  
PUT http://127.0.0.1:8000/api/product/{id}  
DELETE http://127.0.0.1:8000/api/product/{id}

disini kita gunakan :

http://localhost:8000/api/product
