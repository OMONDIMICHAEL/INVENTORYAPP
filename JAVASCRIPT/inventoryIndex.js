const salesAndOrderBtn = document.getElementById("salesAndOrderBtn");
const wholesalerRegNavBtn = document.getElementById("wholesalerRegNavBtn");
const wholesalerLoginNavBtn = document.getElementById("wholesalerLoginNavBtn");
const registerNavBtn = document.getElementById("registerNavBtn");
const inventoryTrackingBtn = document.getElementById("inventoryTrackingBtn");
const loginNavBtn = document.getElementById("loginNavBtn");
const mySalesSec = document.getElementById("mySalesSec");
const makeOrderSec = document.getElementById("makeOrderSec");
const myOrdersSec = document.getElementById("myOrdersSec");
const wholesalerSalesAndOrderBtn = document.getElementById("wholesalerSalesAndOrderBtn");
const mySalesBtn = document.getElementById("mySalesBtn");
const myOrdersBtn = document.getElementById("myOrdersBtn");
const makeOrderBtn = document.getElementById("makeOrderBtn");
const addSupplierProductSec = document.getElementById("addSupplierProductSec");
const supplierSalesBtn = document.getElementById("supplierSalesBtn");
const supplierAddProductBtn = document.getElementById("supplierAddProductBtn");
const confirmOrderBtn = document.getElementById("confirmOrderBtn");
const supplierOrderInvoiceSec = document.getElementById("supplierOrderInvoiceSec");
const supplierInventoryTrackingBtn = document.getElementById("supplierInventoryTrackingBtn");
const downloadInvoiceBtn = document.getElementById("downloadInvoiceBtn");
const closeMenuIcon = document.getElementById("closeMenuIcon");
const mainArtSec1 = document.getElementById("mainArtSec1");
const mainArt1 = document.getElementById("mainArt1");
const openMenuIcon = document.getElementById("openMenuIcon");

document.addEventListener('DOMContentLoaded', function() {
        if (wholesalerSalesAndOrderBtn) {
        wholesalerSalesAndOrderBtn.addEventListener("click", function (params) {
            location.href = "../WHOLESALER/mySalesAndOrder.php"
        });}
        if (mySalesBtn) {
        mySalesBtn.addEventListener("click", function () {
            makeOrderSec.style.display = "none"
            myOrdersSec.style.display = "none"
            mySalesSec.style.display = "block"
        });}
        if (myOrdersBtn) {
        myOrdersBtn.addEventListener("click", function () {
            makeOrderSec.style.display = "none"
            mySalesSec.style.display = "none"
            myOrdersSec.style.display = "block"
        });}
        if (makeOrderBtn) {
        makeOrderBtn.addEventListener("click", function () {
            myOrdersSec.style.display = "none"
            makeOrderSec.style.display = "block"
            mySalesSec.style.display = "none"
        });}
        if (loginNavBtn) {
        loginNavBtn.addEventListener("click", function () {
            location.href = "supplierLogin.php"
        });}
        if (inventoryTrackingBtn) {
        inventoryTrackingBtn.addEventListener("click", function () {
            location.href = "inventoryIndex.php"
        });}
        if (supplierInventoryTrackingBtn) {
        supplierInventoryTrackingBtn.addEventListener("click", function () {
            location.href = "supplierIndex.php"
        });}
        if (registerNavBtn) {
        registerNavBtn.addEventListener("click", function () {
            location.href = "supplierSignup.php"
        });}
        if (wholesalerLoginNavBtn) {
        wholesalerLoginNavBtn.addEventListener("click", function () {
            location.href = "wholesalerLogin.php"
        });}
        if (wholesalerRegNavBtn) {
        wholesalerRegNavBtn.addEventListener("click", function () {
            location.href = "wholesalerSignup.php"
        });}
        if (salesAndOrderBtn) {
        salesAndOrderBtn.addEventListener("click", function () {
        location.href='supplierSalesAndOrder.php';
        });}
        if (supplierAddProductBtn) {
        supplierAddProductBtn.addEventListener("click", function () {
        addSupplierProductSec.style.display="block"
        supplierOrderInvoiceSec.style.display='none'
        });}
        if (confirmOrderBtn) {
        confirmOrderBtn.addEventListener("click", function () {
        addSupplierProductSec.style.display="none";
        supplierOrderInvoiceSec.style.display='block';
        });}
        if (downloadInvoiceBtn) {
        downloadInvoiceBtn.addEventListener("click", function(){
        const supplierInvoiveTable = document.getElementById('supplierInvoice');
        newWin = window.open("");
        newWin.document.write(supplierInvoiveTable.outerHTML);
        newWin.print();
        newWin.close();
        });}
        if (closeMenuIcon) {
        closeMenuIcon.addEventListener("click", function(){
        mainArt1.style.display = "none";
        closeMenuIcon.style.display = "none";
        openMenuIcon.style.display = "block";
        });}
        if (openMenuIcon) {
        openMenuIcon.addEventListener("click", function(){
        mainArt1.style.display = "block";
        closeMenuIcon.style.display = "block";
        openMenuIcon.style.display = "none";
        });}
        if (disableTxt) {
        disableTxt.disabled = true;
        }
});//disableTxt.disabled = true;
function myProfileOptClick(params) {
    console.log("opt1clk")
}
function logoutProfileOptClick(params) {
    location.href = "../SUPPLIER/supplierLogout.php"
}
function editProfileOptClick(params) {
    location.href = "editSupplierProfile.php";
    console.log("rt");
}
function logoutWholesalerOptClick(params) {
    location.href = "../WHOLESALER/wholesalerLogout.php"
}