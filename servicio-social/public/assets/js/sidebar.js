let sidebar = document.querySelector(".sidebar__contenedor");
let sidebarBtn = document.querySelector("#btn_opciones");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
});
