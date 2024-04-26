
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
const supplierSalesSec = document.getElementById("supplierSalesSec");
const supplierInventoryTrackingBtn = document.getElementById("supplierInventoryTrackingBtn");
const downloadInvoiceBtn = document.getElementById("downloadInvoiceBtn");
// const closeMenuIcon = document.getElementById("closeMenuIcon");
// const mainArtSec1 = document.getElementById("mainArtSec1");
// const mainArt1 = document.getElementById("mainArt1");
// const openMenuIcon = document.getElementById("openMenuIcon");

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
        supplierSalesSec.style.display='none';
        });}
        if (confirmOrderBtn) {
        confirmOrderBtn.addEventListener("click", function () {
        addSupplierProductSec.style.display="none";
        supplierSalesSec.style.display='none';
        supplierOrderInvoiceSec.style.display='block';
        });}
        if (supplierSalesBtn) {
        supplierSalesBtn.addEventListener("click", function () {
        addSupplierProductSec.style.display="none";
        supplierOrderInvoiceSec.style.display='none';
        supplierSalesSec.style.display='block';
        });}
        if (downloadInvoiceBtn) {
        downloadInvoiceBtn.addEventListener("click", function(){
        const supplierInvoiveTable = document.getElementById('supplierInvoice');
        newWin = window.open("");
        newWin.document.write(supplierInvoiveTable.outerHTML);
        newWin.print();
        newWin.close();
        });}
        // if (closeMenuIcon) {
        // closeMenuIcon.addEventListener("click", function(){
        // mainArt1.style.display = "none";
        // closeMenuIcon.style.display = "none";
        // openMenuIcon.style.display = "block";
        // });}
        // if (openMenuIcon) {
        // openMenuIcon.addEventListener("click", function(){
        // mainArt1.style.display = "block";
        // closeMenuIcon.style.display = "block";
        // openMenuIcon.style.display = "none";
        // });}
});
function toggleDarkMode() {
    const bodyElement = document.body;
    bodyElement.classList.toggle("dark-mode");
    
    // Save the current mode to local storage
    if(bodyElement.classList.contains("dark-mode")) {
      localStorage.setItem("theme", "dark");
    } else {
      localStorage.setItem("theme", "light");
    }
  }
  
  // Check for saved user preference, if any, on page load
  document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme");
    
    // Apply the saved theme
    if(savedTheme === "dark") {
      document.body.classList.add("dark-mode");
    }
  });
//   ///////////////////////////////
