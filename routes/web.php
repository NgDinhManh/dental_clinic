<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthContronller;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\BenhAnController;
use App\Http\Controllers\Doctor\BenhNhanController;
use App\Http\Controllers\Doctor\LichLamViecController;
use App\Http\Controllers\Doctor\DonThuocController;
use App\Http\Controllers\Receptionist\ReceptionistController;
use App\Http\Controllers\Receptionist\ReceptPatientController;
use App\Http\Controllers\Receptionist\ReceptAppointmentController;
use App\Http\Controllers\Receptionist\ReceptInvoiceController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryServiceController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\ReceptionistController as AdminReceptionistController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Controller;
use App\Http\Middleware\PatientMiddleware;
use App\Http\Controllers\ChatbotController;

Route::get('/register', [AuthContronller::class, 'register'])->name('register');
Route::post('/register', [AuthContronller::class, 'check_register']);

Route::get('/login', [AuthContronller::class, 'login'])->name('login');
Route::post('/login', [AuthContronller::class, 'check_login'])->name('check_login');

Route::post('/logout', [AuthContronller::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/home/post', [HomeController::class, 'post'])->name('home/post');
Route::get('/home/post-detail/{post}', [HomeController::class, 'post_detail'])->name('home/post-detail');
Route::get('/home/post-event', [HomeController::class, 'post_event'])->name('home/post-event');
Route::get('/home/post-knowledge', [HomeController::class, 'post_knowledge'])->name('home/post-knowledge');
Route::get('/home/post-service', [HomeController::class, 'post_service'])->name('home/post-service');
Route::get('/home/service', [HomeController::class, 'service'])->name('home/service');

Route::get('/home/about', [HomeController::class, 'about'])->name('home/about');
Route::get('/home/contact', [HomeController::class, 'contact'])->name('home/contact');
Route::post('/home/contact/send', [HomeController::class, 'sendEmail'])->name('home/contact/send');

Route::get('/home/appointment', [HomeController::class, 'appointment'])->name('home/appointment');
Route::get('/home/appointment/slots', [HomeController::class, 'getSlots'])->name('home/appointment/slots');
Route::post('/home/appointment/create', [HomeController::class, 'appointment_create'])->name('home/appointment/create');

Route::get('/notification/{id}', [NotificationController::class, 'notificationDetail'])->name('notification/detail');
Route::put('/notification/markAsRead/{notification}', [NotificationController::class, 'markAsRead'])->name('notification/markAsRead');
Route::put('/notification/markAsDeleted/{notification}', [NotificationController::class, 'markAsDeleted'])->name('notification/markAsDeleted');

// Route cho Chatbot
Route::post('/chat-message', [ChatbotController::class, 'handleMessage']);

// Admin Routes
Route::group(['middleware' => ['auth', 'auth.admin']], function () {
    Route::get('/admin/statistic', [AuthContronller::class, 'admin_index'])->name('admin/index');
    Route::get('/admin/statistic/service', [StatisticController::class, 'statistic_service'])->name('admin/statistic/service');
    Route::get('/admin/statistic/revenue', [StatisticController::class, 'statistic_revenue'])->name('admin/statistic/revenue');

    Route::get('/admin/menu', [MenuController::class, 'index'])->name('admin/menu');
    Route::get('/admin/menu/create', [MenuController::class, 'create'])->name('admin/menu/create');
    Route::post('/admin/menu/store', [MenuController::class, 'store'])->name('admin/menu/store');
    Route::get('/admin/menu/show/{menu}', [MenuController::class, 'show'])->name('admin/menu/show');
    Route::get('/admin/menu/edit/{menu}', [MenuController::class, 'edit'])->name('admin/menu/edit');
    Route::put('/admin/menu/update/{menu}', [MenuController::class, 'update'])->name('admin/menu/update');
    Route::delete('/admin/menu/destroy/{menu}', [MenuController::class, 'destroy'])->name('admin/menu/destroy');

    Route::get('/admin/user', [UserController::class, 'index'])->name('admin/user');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin/user/create');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin/user/store');
    Route::get('/admin/user/show/{user}', [UserController::class, 'show'])->name('admin/user/show');
    Route::get('/admin/user/edit/{user}', [UserController::class, 'edit'])->name('admin/user/edit');
    Route::put('/admin/user/update/{user}', [UserController::class, 'update'])->name('admin/user/update');
    Route::post('/admin/user/reset_password/{user}', [UserController::class, 'reset_password'])->name('admin/user/reset_password');
    Route::delete('/admin/user/destroy/{user}', [UserController::class, 'destroy'])->name('admin/user/destroy');

    Route::get('/admin/post', [PostController::class, 'index'])->name('admin/post');
    Route::get('/admin/post/create', [PostController::class, 'create'])->name('admin/post/create');
    Route::post('/admin/post/store', [PostController::class, 'store'])->name('admin/post/store');
    Route::get('/admin/post/show/{post}', [PostController::class, 'show'])->name('admin/post/show');
    Route::get('/admin/post/edit/{post}', [PostController::class, 'edit'])->name('admin/post/edit');
    Route::put('/admin/post/update/{post}', [PostController::class, 'update'])->name('admin/post/update');
    Route::delete('/admin/post/destroy/{post}', [PostController::class, 'destroy'])->name('admin/post/destroy');
    Route::post('/admin/post/upload', [PostController::class, 'upload'])->name('admin/post/upload');

    Route::get('/admin/service', [ServiceController::class, 'index'])->name('admin/service');
    Route::get('/admin/service/create', [ServiceController::class, 'create'])->name('admin/service/create');
    Route::post('/admin/service/store', [ServiceController::class, 'store'])->name('admin/service/store');
    Route::get('/admin/service/show/{service}', [ServiceController::class, 'show'])->name('admin/service/show');
    Route::get('/admin/service/edit/{service}', [ServiceController::class, 'edit'])->name('admin/service/edit');
    Route::put('/admin/service/update/{service}', [ServiceController::class, 'update'])->name('admin/service/update');
    Route::delete('/admin/service/destroy/{service}', [ServiceController::class, 'destroy'])->name('admin/service/destroy');

    Route::get('/admin/category-service', [CategoryServiceController::class, 'index'])->name('admin/category-service');
    Route::get('/admin/category-service/create', [CategoryServiceController::class, 'create'])->name('admin/category-service/create');
    Route::post('/admin/category-service/store', [CategoryServiceController::class, 'store'])->name('admin/category-service/store');
    Route::get('/admin/category-service/show/{category_service}', [CategoryServiceController::class, 'show'])->name('admin/category-service/show');
    Route::get('/admin/category-service/edit/{category_service}', [CategoryServiceController::class, 'edit'])->name('admin/category-service/edit');
    Route::put('/admin/category-service/update/{category_service}', [CategoryServiceController::class, 'update'])->name('admin/category-service/update');
    Route::delete('/admin/category-service/destroy/{category_service}', [CategoryServiceController::class, 'destroy'])->name('admin/category-service/destroy');

    Route::get('/admin/doctor', [AdminDoctorController::class, 'index'])->name('admin/doctor');
    Route::get('/admin/doctor/create', [AdminDoctorController::class, 'create'])->name('admin/doctor/create');
    Route::post('/admin/doctor/store', [AdminDoctorController::class, 'store'])->name('admin/doctor/store');
    Route::get('/admin/doctor/show/{doctor}', [AdminDoctorController::class, 'show'])->name('admin/doctor/show');
    Route::get('/admin/doctor/edit/{doctor}', [AdminDoctorController::class, 'edit'])->name('admin/doctor/edit');
    Route::put('/admin/doctor/update/{doctor}', [AdminDoctorController::class, 'update'])->name('admin/doctor/update');
    Route::delete('/admin/doctor/destroy/{doctor}', [AdminDoctorController::class, 'destroy'])->name('admin/doctor/destroy');
    Route::get('/admin/doctor/benh-an', [AdminDoctorController::class, 'benh_an'])->name('admin/doctor/benh-an');
    Route::get('/admin/doctor/benh-an-show/{record_id}', [AdminDoctorController::class, 'benh_an_show'])->name('admin/doctor/benh-an-show');
    Route::get('/admin/doctor/benh-an-reopen/{record_id}', [AdminDoctorController::class, 'benh_an_reopen'])->name('admin/doctor/benh-an-reopen');
    Route::get('/admin/doctor/benh-an-decline/{record_id}', [AdminDoctorController::class, 'benh_an_decline'])->name('admin/doctor/benh-an-decline');

    Route::get('/admin/receptionist', [AdminReceptionistController::class, 'index'])->name('admin/receptionist');
    Route::get('/admin/receptionist/create', [AdminReceptionistController::class, 'create'])->name('admin/receptionist/create');
    Route::post('/admin/receptionist/store', [AdminReceptionistController::class, 'store'])->name('admin/receptionist/store');
    Route::get('/admin/receptionist/show/{receptionist}', [AdminReceptionistController::class, 'show'])->name('admin/receptionist/show');
    Route::get('/admin/receptionist/edit/{receptionist}', [AdminReceptionistController::class, 'edit'])->name('admin/receptionist/edit');
    Route::put('/admin/receptionist/update/{receptionist}', [AdminReceptionistController::class, 'update'])->name('admin/receptionist/update');
    Route::delete('/admin/receptionist/destroy/{receptionist}', [AdminReceptionistController::class, 'destroy'])->name('admin/receptionist/destroy');
    Route::get('/admin/receptionist/invoice', [AdminReceptionistController::class, 'invoice'])->name('admin/receptionist/invoice');
    Route::get('/admin/receptionist/invoice/show/{invoice_id}', [AdminReceptionistController::class, 'invoice_show'])->name('admin/receptionist/invoice/show');
    Route::get('/admin/receptionist/invoice/reopen/{invoice_id}', [AdminReceptionistController::class, 'invoice_reopen'])->name('admin/receptionist/invoice/reopen');
    Route::get('/admin/receptionist/invoice/decline/{invoice_id}', [AdminReceptionistController::class, 'invoice_decline'])->name('admin/receptionist/invoice/decline');

    Route::get('/admin/faq', [FaqController::class, 'index'])->name('admin/faq');
    Route::get('/admin/faq/create', [FaqController::class, 'create'])->name('admin/faq/create');
    Route::post('/admin/faq/store', [FaqController::class, 'store'])->name('admin/faq/store');
    Route::get('/admin/faq/show/{faq}', [FaqController::class, 'show'])->name('admin/faq/show');
    Route::get('/admin/faq/edit/{faq}', [FaqController::class, 'edit'])->name('admin/faq/edit');
    Route::put('/admin/faq/update/{faq}', [FaqController::class, 'update'])->name('admin/faq/update');
    Route::delete('/admin/faq/destroy/{faq}', [FaqController::class, 'destroy'])->name('admin/faq/destroy');

    Route::get('/admin/notification', [NotificationController::class, 'index'])->name('admin/notification');
    Route::get('/admin/notification/create', [NotificationController::class, 'create'])->name('admin/notification/create');
    Route::post('/admin/notification/store', [NotificationController::class, 'store'])->name('admin/notification/store');
    Route::get('/admin/notification/show/{notification}', [NotificationController::class, 'show'])->name('admin/notification/show');
    Route::get('/admin/notification/edit/{notification}', [NotificationController::class, 'edit'])->name('admin/notification/edit');
    Route::put('/admin/notification/update/{notification}', [NotificationController::class, 'update'])->name('admin/notification/update');
    Route::delete('/admin/notification/destroy/{notification}', [NotificationController::class, 'destroy'])->name('admin/notification/destroy');

    Route::get('/admin/message', [MessageController::class, 'index'])->name('admin/message');
    Route::get('/admin/message/show/{message}', [MessageController::class, 'show'])->name('admin/message/show');
    Route::get('/admin/message/reply/{message}', [MessageController::class, 'reply'])->name('admin/message/reply');
    Route::put('/admin/message/update/{message}', [MessageController::class, 'update'])->name('admin/message/update');
    Route::delete('/admin/message/destroy/{message}', [MessageController::class, 'destroy'])->name('admin/message/destroy');

});

// Doctor Routes
Route::group(['middleware' => ['auth', 'auth.doctor']], function () {
    Route::get('/doctor', [AuthContronller::class, 'doctor_index'])->name('doctor/index');

    Route::get('/doctor/profile/{doctor_id}', [DoctorController::class, 'doctor_profile'])->name('doctor/profile');
    Route::put('/doctor/update/{user}', [DoctorController::class, 'doctor_update'])->name('doctor/update');
    Route::get('/doctor/change-password/{doctor_id}', [DoctorController::class, 'doctor_change_password'])->name('doctor/change-password');
    Route::put('/doctor/change-password-update/{doctor_id}', [DoctorController::class, 'doctor_change_password_update'])->name('doctor/change-password-update');

    Route::get('/doctor/lich-lam-viec/lich-kham-hom-nay', [LichLamViecController::class, 'lich_kham_hom_nay'])->name('doctor/lich-lam-viec/lich-kham-hom-nay');
    Route::get('/doctor/lich-lam-viec/lich-kham-tuan-nay', [LichLamViecController::class, 'lich_kham_tuan_nay'])->name('doctor/lich-lam-viec/lich-kham-tuan-nay');
    Route::get('/doctor/lich-lam-viec/lich-kham', [LichLamViecController::class, 'lich_kham'])->name('doctor/lich-lam-viec/lich-kham');
    Route::get('/doctor/lich-lam-viec/kham-benh-lich/{appointment_id}', [LichLamViecController::class, 'kham_benh_lich'])->name('doctor/lich-lam-viec/kham-benh-lich');
    Route::post('/doctor/lich-lam-viec/kham-benh-lich/store', [LichLamViecController::class, 'kham_benh_lich_store'])->name('doctor/lich-lam-viec/kham-benh-lich/store');
    Route::get('/doctor/lich-lam-viec/kham-benh-lich-huy/{appointment_id}', [LichLamViecController::class, 'kham_benh_lich_huy'])->name('doctor/lich-lam-viec/kham-benh-lich-huy');

    Route::get('/doctor/benh-nhan/benh-nhan-tung-kham', [BenhNhanController::class, 'benh_nhan_tung_kham'])->name('doctor/benh-nhan/benh-nhan-tung-kham');
    Route::get('/doctor/benh-nhan/benh-nhan', [BenhNhanController::class, 'benh_nhan'])->name('doctor/benh-nhan/benh-nhan');
    Route::get('/doctor/benh-nhan/benh-nhan-benh-an/{patient_id}', [BenhNhanController::class, 'benh_nhan_benh_an'])->name('doctor/benh-nhan/benh-nhan-benh-an');
    Route::get('/doctor/benh-nhan/benh-nhan/show/{patient_id}', [BenhNhanController::class, 'benh_nhan_show'])->name('doctor/benh-nhan/benh-nhan/show');

    Route::get('/doctor/benh-an/benh-an', [BenhAnController::class, 'benh_an'])->name('doctor/benh-an/benh-an');
    Route::get('/doctor/benh-an/benh-an/show/{record_id}', [BenhAnController::class, 'benh_an_show'])->name('doctor/benh-an/benh-an/show');
    Route::get('/doctor/benh-an/benh-an/print/{record_id}', [BenhAnController::class, 'benh_an_print'])->name('doctor/benh-an/benh-an/print');
    Route::get('/doctor/benh-an/benh-an/edit/{record_id}', [BenhAnController::class, 'benh_an_edit'])->name('doctor/benh-an/benh-an/edit');
    Route::put('/doctor/benh-an/benh-an/update/{record_id}', [BenhAnController::class, 'benh_an_update'])->name('doctor/benh-an/benh-an/update');
    Route::get('/doctor/benh-an/benh-an/hoan-tat/{record_id}', [BenhAnController::class, 'hoan_tat_benh_an'])->name('doctor/benh-an/benh-an/hoan-tat');
    Route::get('/doctor/benh-an/benh-an-dang-dieu-tri', [BenhAnController::class, 'benh_an_dang_dieu_tri'])->name('doctor/benh-an/benh-an-dang-dieu-tri');
    Route::get('/doctor/benh-an/benh-an-hoan-tat', [BenhAnController::class, 'benh_an_hoan_tat'])->name('doctor/benh-an/benh-an-hoan-tat');
    Route::get('/doctor/benh-an/benh-an-reopen/{record_id}', [BenhAnController::class, 'benh_an_reopen'])->name('doctor/benh-an/benh-an-reopen');

    Route::get('/doctor/don-thuoc/don-thuoc', [DonThuocController::class, 'don_thuoc'])->name('doctor/don-thuoc/don-thuoc');
    Route::get('/doctor/don-thuoc/don-thuoc-create/{record_id}', [DonThuocController::class, 'don_thuoc_create'])->name('doctor/don-thuoc/don-thuoc-create');
    Route::post('/doctor/don-thuoc/don-thuoc-store', [DonThuocController::class, 'don_thuoc_store'])->name('doctor/don-thuoc/don-thuoc-store');
    Route::get('/doctor/don-thuoc/don-thuoc-edit/{record_id}', [DonThuocController::class, 'don_thuoc_edit'])->name('doctor/don-thuoc/don-thuoc-edit');
    Route::put('/doctor/don-thuoc/don-thuoc-update/{record_id}', [DonThuocController::class, 'don_thuoc_update'])->name('doctor/don-thuoc/don-thuoc-update');
    Route::get('/doctor/don-thuoc/don-thuoc-show/{record_id}', [DonThuocController::class, 'don_thuoc_show'])->name('doctor/don-thuoc/don-thuoc-show');
});

// Receptionist Routes
Route::group(['middleware' => ['auth', 'auth.receptionist']], function () {
    Route::get('/receptionist', [AuthContronller::class, 'recep_index'])->name('receptionist/index');

    Route::get('/receptionist/profile/{receptionist_id}', [ReceptionistController::class, 'receptionist_profile'])->name('receptionist/profile');
    Route::put('/receptionist/update/{user}', [ReceptionistController::class, 'receptionist_update'])->name('receptionist/update');
    Route::get('/receptionist/change-password/{receptionist_id}', [ReceptionistController::class, 'receptionist_change_password'])->name('receptionist/change-password');
    Route::put('/receptionist/change-password-update/{receptionist_id}', [ReceptionistController::class, 'receptionist_change_password_update'])->name('receptionist/change-password-update');

    Route::get('/receptionist/patient', [ReceptPatientController::class, 'patient'])->name('receptionist/patient');
    Route::get('/receptionist/patient/create', [ReceptPatientController::class, 'patient_create'])->name('receptionist/patient/create');
    Route::post('/receptionist/patient/store', [ReceptPatientController::class, 'patient_store'])->name('receptionist/patient/store');
    Route::get('/receptionist/patient/show/{patient_id}', [ReceptPatientController::class, 'patient_show'])->name('receptionist/patient/show');
    Route::get('/receptionist/patient/edit/{patient_id}', [ReceptPatientController::class, 'patient_edit'])->name('receptionist/patient/edit');
    Route::put('/receptionist/patient/update/{patient_id}', [ReceptPatientController::class, 'patient_update'])->name('receptionist/patient/update');

    Route::get('/receptionist/appointment', [ReceptAppointmentController::class, 'appointment'])->name('receptionist/appointment');
    Route::get('/receptionist/appointment/create', [ReceptAppointmentController::class, 'appointment_create'])->name('receptionist/appointment/create');
    Route::post('/receptionist/appointment/store', [ReceptAppointmentController::class, 'appointment_store'])->name('receptionist/appointment/store');
    Route::get('/receptionist/appointment/show/{appointment_id}', [ReceptAppointmentController::class, 'appointment_show'])->name('receptionist/appointment/show');
    Route::get('/receptionist/appointment/edit/{appointment_id}', [ReceptAppointmentController::class, 'appointment_edit'])->name('receptionist/appointment/edit');
    Route::put('/receptionist/appointment/update/{appointment_id}', [ReceptAppointmentController::class, 'appointment_update'])->name('receptionist/appointment/update');

    Route::get('/receptionist/invoice', [ReceptInvoiceController::class, 'invoice'])->name('receptionist/invoice');
    Route::get('/receptionist/invoice/reload', [ReceptInvoiceController::class, 'invoice_reload'])->name('receptionist/invoice/reload');
    Route::get('/receptionist/invoice/show/{invoice_id}', [ReceptInvoiceController::class, 'invoice_show'])->name('receptionist/invoice/show');
    Route::get('/receptionist/invoice/print/{invoice_id}', [ReceptInvoiceController::class, 'invoice_print'])->name('receptionist/invoice/print');
    Route::get('/receptionist/invoice/edit/{invoice_id}', [ReceptInvoiceController::class, 'invoice_edit'])->name('receptionist/invoice/edit');
    Route::put('/receptionist/invoice/update/{invoice_id}', [ReceptInvoiceController::class, 'invoice_update'])->name('receptionist/invoice/update');
    Route::put('/receptionist/invoice/pay/{invoice_id}', [ReceptInvoiceController::class, 'invoice_pay'])->name('receptionist/invoice/pay');
    Route::put('/receptionist/invoice/cancel/{invoice_id}', [ReceptInvoiceController::class, 'invoice_cancel'])->name('receptionist/invoice/cancel');
    Route::get('/receptionist/invoice/reopen/{invoice_id}', [ReceptInvoiceController::class, 'invoice_reopen'])->name('receptionist/invoice/reopen');
});

// Patient Routes
Route::middleware(['auth', PatientMiddleware::class])->group(function () {
    Route::get('/patient/account/{user}', [PatientController::class, 'patient_account'])->name('patient/account');
    Route::put('/patient/account/update/{user}', [PatientController::class, 'patient_account_update'])->name('patient/account/update');
    Route::get('/patient/profile/{user}', [PatientController::class, 'patient_profile'])->name('patient/profile');
    Route::put('/patient/profile/update/{user}', [PatientController::class, 'patient_profile_update'])->name('patient/profile/update');
    Route::get('/patient/change-password/{user}', [PatientController::class, 'patient_change_password'])->name('patient/change-password');
    Route::put('/patient/change-password-update/{user}', [PatientController::class, 'patient_change_password_update'])->name('patient/change-password-update');

    Route::get('/patient/appointment/{patient}', [PatientController::class, 'patient_appointment'])->name('patient/appointment');
    Route::get('/patient/appointment-destroy/{appointment_id}', [PatientController::class, 'patient_appointment_destroy'])->name('patient/appointment-destroy');

    Route::get('/patient/medical-record/{patient}', [PatientController::class, 'patient_medical_record'])->name('patient/medical-record');
    Route::get('/patient/medical-record-detail/{record_id}', [PatientController::class, 'patient_medical_record_detail'])->name('patient/medical-record-detail');
    Route::get('/patient/invoice/{invoice_id}', [PatientController::class, 'patient_invoice'])->name('patient/invoice');

});
