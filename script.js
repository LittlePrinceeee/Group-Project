
document.addEventListener('DOMContentLoaded', function(){   
    let cartButtons = document.querySelectorAll('.cart');
    let cartText = document.querySelector('.userCart');
    let count = 0;
    cartButtons.forEach(function(button){
        button.addEventListener('click', userCart)
    })

    function userCart(){
    count++;
    cartText.textContent = `Your Cart: ${count}`
}
});




