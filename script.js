const text = document.querySelector(".name");
const text1 = document.querySelector(".occup");

const textLoad = () => {
setTimeout(() => {
    text.textContent = "Who?";
},0);
setTimeout(() => {
    text.textContent = "What?";
},2000);
setTimeout(() => {
    text.textContent = "Slim Shady";
},4000);
  

}



textLoad();


