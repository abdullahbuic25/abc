const cookie = document.querySelector("#cookie")
const accept = document.querySelector(".accept-cookie")
const deny = document.querySelector(".deby-cookie")
const cookieCont = document.querySelector(".cookie-container")

deny.innerText = "Reject"

if(localStorage.getItem("cookie")==null){
    cookie.style.display = "block"
}
else{
    cookie.style.display = "none"
}

accept.addEventListener("click", ()=>{
    localStorage.setItem("cookie", "accept")
    cookie.style.display = "none"
})

deny.addEventListener("click", ()=>{
    localStorage.setItem("cookie", "reject")
    cookie.style.display = "none"
})