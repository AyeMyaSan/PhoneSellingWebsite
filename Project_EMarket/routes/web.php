<?php

Route::get('/', 'UserProductController@welcome')->name('home');

Auth::routes();

Route::group(['middleware' => ['admin']], function () {
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

  Route::get('/profile', 'UserController@profileShow')->name('profileShow');
  Route::post('profile/update','UserController@profileUpdate')->name('profileUpdate');
  Route::get('/show/customer','UserController@showCustomer')->name('showCustomer');
  Route::get('/customer-list','UserController@customerList')->name('customerList');

  Route::get('/delete/customer/{id}','UserController@customerDelete')->name('customerDelete');
  Route::get('admin/addUser', 'UserController@showAddUser')->name('showAddUser');
  Route::post('/addUser','UserController@addNewUser')->name('addNewUser');
  Route::get('userdata/editshow/{id}', 'UserController@showEditUser')->name('showEditUser');
  Route::post('user/update', 'UserController@userUpdate')->name('userUpdate');
  Route::post('admin/profile/update', 'UserController@saveChange')->name('saveChange');

  
  Route::get('/newsAdd','PostController@newsAdd')->name('newsAdd');
  Route::post('/newsAdd','PostController@newsAdd')->name('newsAdd');
  Route::get('/show/newsAdd', 'PostController@showNewsAdd')->name('showNewsAdd');
  Route::get('/showDashboard', 'PostController@showDashboard')->name('showDashboard');
  Route::get('/show/news','PostController@news')->name('news');
  Route::get('/news-list','PostController@newsList')->name('newsList');
  Route::get('news/editshow/{id}', 'PostController@newsEditShow')->name('newsEditShow');
  Route::get('/news/delete/{id}', 'PostController@newsDelete')->name('newsDelete');
  Route::post('/update', 'PostController@newsUpdate')->name('newsUpdate');
  Route::get('/product/show/newslist', 'PostController@showNewsList')->name('showNewsList');
  Route::get('/news/detail/{id}', 'PostController@showNewsDetail')->name('showNewsDetail');
  Route::get('/recent/News','PostController@recentNews')->name('recentNews');
  Route::get('/recent/Items','PostController@recentItems')->name('recentItems');
  Route::get('/admins','PostController@Admins')->name('Admins');
  Route::get('/customers','PostController@Customers')->name('Customers');
  Route::get('/orders','PostController@Orders')->name('Orders');
  Route::get('/items','PostController@Sales')->name('Sales');
  Route::get('/revenues','PostController@Revenues')->name('Revenues');
  Route::get('/show/News','PostController@AllNews')->name('AllNews');
  Route::get('/Mobile','PostController@Mobile')->name('Mobile');
  Route::get('/Laptop','PostController@Laptop')->name('Laptop');
  Route::get('/Tablet','PostController@Tablet')->name('Tablet');

  Route::get('/product/addProduct','ProductController@showProductAdd')->name('showProductAdd');
  Route::get('/product/add/','ProductController@addProduct')->name('addProduct');
  Route::post('/product/add/show','ProductController@addProduct')->name('addProduct');
  Route::get('/show/product','ProductController@showMyProduct')->name('showMyProduct');
  Route::get('/product-list','ProductController@productList')->name('productList');
  Route::get('/product/delete/{id}', 'ProductController@productDelete')->name('productDelete');  
  Route::get('prodcut/editshow/{id}', 'ProductController@productEditShow')->name('productEditShow');
  Route::post('/product/edit', 'ProductController@productUpdate')->name('productUpdate');

 
  Route::get('/product/detail/{id}', 'UserProductController@showProductDetail')->name('showProductDetail');
  Route::get('cart', 'UserProductController@showProductCart')->name('showProductCart');
  Route::patch('update-cart', 'UserProductController@update');
  Route::delete('remove-from-cart', 'UserProductController@remove');
  Route::post('/product/cart', 'UserProductController@addToCart')->name('addToCart');
  Route::patch('update-cart', 'UserProductController@update');
  Route::delete('remove-from-cart', 'UserProductController@remove');
  Route::post('user/register', 'UserProductController@showUserForm')->name('showUserForm');
  Route::get('user/register', 'UserProductController@showFinalCheckout');
  Route::get('user/checkout', 'UserProductController@')->name('showFinalCheckout');
  Route::get('/home/contactus', 'UserProductController@contactUs')->name('contactUs');
  Route::get('admin/profile', 'UserProductController@showProfile')->name('showProfile');

  Route::post('user/checkout', 'OrderController@checkout')->name('checkout');
  Route::get('/show/orders','OrderController@order')->name('order');
  Route::get('/order-list','OrderController@orderList')->name('orderList');
  Route::get('/delete/order/{id}','OrderController@orderDelete')->name('orderDelete');
  Route::get('/order/detail/{id}', 'OrderController@showOrderDetail')->name('showOrderDetail');
  Route::post('/update/status','OrderController@updateStatus')->name('updateStatus');

  Route::get('/myacc', 'HomeController@myacc')->name('myacc');
  Route::get('/myorders','OrderController@myorders')->name('myorders');
  Route::get('/myorder-list','OrderController@myorderList')->name('myorderList');
  Route::get('/voucher/{id}', 'OrderController@showvoucher')->name('showvoucher');

  Route::post('/wishlist/add','wishlistController@store')->name('store');
  Route::post('/removewishlist', 'WishlistController@removewishlist')->name('removewishlist');
  Route::get('/show/wishlist', 'WishlistController@showwishlist')->name('showwishlist');
  Route::get('/delete/wishlist/{id}','WishlistController@deletewishlist')->name('delwishlist');
  Route::get('/wishlist','WishlistController@mywishlist')->name('mywishlist');

  
});


Route::group(['middleware'=>['auth']], function(){
    Route::get('/home/contactus', 'UserProductController@contactUs')->name('contactUs');
    Route::post('/send/message','UserController@contact')->name('contact');

    Route::post('/addReview','UserProductController@addReview')->name('addReview');
    Route::get('/show/reviews','UserProductController@review')->name('review');
    Route::get('/review-list','UserProductController@reviewList')->name('reviewList');
    Route::get('/review/detail/{id}', 'UserProductController@showReviewDetail')->name('showReviewDetail');
    Route::post('update/status/{id}/{status}','UserProductController@updateRStatus')->name('updateRStatus');
    Route::get('/delete/review/{id}','UserProductController@reviewDel')->name('reviewDel');

    Route::get('/home', 'HomeController@index')->name('home');
   
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::get('/profile', 'UserController@profileShow')->name('profileShow');
    Route::post('profile/update','UserController@profileUpdate')->name('profileUpdate');
    Route::get('/show/customer','UserController@showCustomer')->name('showCustomer');
    Route::get('/customer-list','UserController@customerList')->name('customerList');

    Route::get('/delete/customer/{id}','UserController@customerDelete')->name('customerDelete');
    Route::get('admin/addUser', 'UserController@showAddUser')->name('showAddUser');
    Route::post('/addUser','UserController@addNewUser')->name('addNewUser');
    Route::get('userdata/editshow/{id}', 'UserController@showEditUser')->name('showEditUser');
    Route::post('user/update', 'UserController@userUpdate')->name('userUpdate');
    Route::post('admin/profile/update', 'UserController@saveChange')->name('saveChange');

    
    Route::get('/newsAdd','PostController@newsAdd')->name('newsAdd');
    Route::post('/newsAdd','PostController@newsAdd')->name('newsAdd');
    Route::get('/show/newsAdd', 'PostController@showNewsAdd')->name('showNewsAdd');
    Route::get('/showDashboard', 'PostController@showDashboard')->name('showDashboard');
    Route::get('/show/news','PostController@news')->name('news');
    Route::get('/news-list','PostController@newsList')->name('newsList');
    Route::get('news/editshow/{id}', 'PostController@newsEditShow')->name('newsEditShow');
    Route::get('/news/delete/{id}', 'PostController@newsDelete')->name('newsDelete');
    Route::post('/update', 'PostController@newsUpdate')->name('newsUpdate');
    Route::get('/product/show/newslist', 'PostController@showNewsList')->name('showNewsList');
    Route::get('/news/detail/{id}', 'PostController@showNewsDetail')->name('showNewsDetail');
    Route::get('/recent/News','PostController@recentNews')->name('recentNews');
    Route::get('/recent/Items','PostController@recentItems')->name('recentItems');
    Route::get('/admins','PostController@Admins')->name('Admins');
    Route::get('/customers','PostController@Customers')->name('Customers');
    Route::get('/orders','PostController@Orders')->name('Orders');
    Route::get('/items','PostController@Sales')->name('Sales');
    Route::get('/revenues','PostController@Revenues')->name('Revenues');
    Route::get('/show/News','PostController@AllNews')->name('AllNews');
    Route::get('/Mobile','PostController@Mobile')->name('Mobile');
    Route::get('/Laptop','PostController@Laptop')->name('Laptop');
    Route::get('/Tablet','PostController@Tablet')->name('Tablet');

    Route::get('/product/addProduct','ProductController@showProductAdd')->name('showProductAdd');
    Route::get('/product/add/','ProductController@addProduct')->name('addProduct');
    Route::post('/product/add/show','ProductController@addProduct')->name('addProduct');
    Route::get('/show/product','ProductController@showMyProduct')->name('showMyProduct');
    Route::get('/product-list','ProductController@productList')->name('productList');
    Route::get('/product/delete/{id}', 'ProductController@productDelete')->name('productDelete');  
    Route::get('prodcut/editshow/{id}', 'ProductController@productEditShow')->name('productEditShow');
    Route::post('/product/edit', 'ProductController@productUpdate')->name('productUpdate');

   
    Route::get('/product/detail/{id}', 'UserProductController@showProductDetail')->name('showProductDetail');
    Route::get('cart', 'UserProductController@showProductCart')->name('showProductCart');
    Route::patch('update-cart', 'UserProductController@update');
    Route::delete('remove-from-cart', 'UserProductController@remove');
    Route::post('/product/cart', 'UserProductController@addToCart')->name('addToCart');
    Route::patch('update-cart', 'UserProductController@update');
    Route::delete('remove-from-cart', 'UserProductController@remove');
    Route::post('user/register', 'UserProductController@showUserForm')->name('showUserForm');
    Route::get('user/register', 'UserProductController@showFinalCheckout');
    Route::get('user/checkout', 'UserProductController@showFinalCheckout')->name('showFinalCheckout');

    Route::post('show/thanku', 'OrderController@checkout')->name('checkout');
    Route::get('continue/homepage', 'UserProductController@continue')->name('continue');
    Route::get('reply/ThankU', 'OrderController@thanku')->name('thanku');

    // Route::get('/home/contactus', 'UserProductController@contactUs')->name('contactUs');
    Route::get('admin/profile', 'UserProductController@showProfile')->name('showProfile');

    Route::post('user/checkout', 'OrderController@checkout')->name('checkout');
    Route::post('/return/Back', 'OrderController@Back')->name('Back');

    Route::get('/show/orders','OrderController@order')->name('order');
    Route::get('/order-list','OrderController@orderList')->name('orderList');
    Route::get('/delete/order/{id}','OrderController@orderDelete')->name('orderDelete');
    Route::get('/order/detail/{id}', 'OrderController@showOrderDetail')->name('showOrderDetail');
    Route::post('update/status','OrderController@updateStatus')->name('updateStatus');

    Route::get('/myacc', 'HomeController@myacc')->name('myacc');
    // Route::get('/wishlist','WishlistController@mywishlist')->name('mywishlist');
    Route::get('/myorders','OrderController@myorders')->name('myorders');
    Route::get('/myorder-list','OrderController@myorderList')->name('myorderList');
    Route::get('/voucher/{id}', 'OrderController@showvoucher')->name('showvoucher');

    Route::post('/wishlist/add','wishlistController@store')->name('store');
    Route::post('/removewishlist', 'WishlistController@removewishlist')->name('removewishlist');
    Route::get('/show/wishlist', 'WishlistController@showwishlist')->name('showwishlist');
    Route::get('/delete/wishlist/{id}','WishlistController@deletewishlist')->name('delwishlist');
    Route::get('/wishlist','WishlistController@mywishlist')->name('mywishlist');
    Route::get('/product_detail/change/image','UserProductController@changeImage')->name('changeImage');
    Route::get('/product_edit/feactures/editor','ProductController@editor')->name('editor');
  
});
//   Route::get('/review', 'UserProductController@showReview')->name('showProductDetail');
  Route::get('/product/smartphone', 'UserProductController@showSmartPhone')->name('showSmartPhone');
  Route::get('/product/tablet', 'UserProductController@showTablet')->name('showTablet');
  Route::get('/product/laptop', 'UserProductController@showLaptop')->name('showLaptop');
  Route::get('/product/detail/{id}', 'UserProductController@showProductDetail')->name('showProductDetail');