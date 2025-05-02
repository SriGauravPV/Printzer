let selectedValue1 = null;
let selectedValue2 = null;
let selectedValue3 = null;
let selectedValue4 = null;
let selectedValue5 = null;
const buttons1 = document.querySelectorAll(".selectable");
buttons1.forEach(button => {
    button.addEventListener("click", function() {
        buttons1.forEach(btn => btn.classList.remove("selected"));
        this.classList.add("selected");
        selectedValue1 = parseFloat(this.value);  
        console.log(getSelectedValue1());
    });
});
function getSelectedValue1() {
    return selectedValue1;
}
const buttons2 = document.querySelectorAll(".b1");
buttons2.forEach(button => {
    button.addEventListener("click", function() {
        buttons2.forEach(btn => btn.classList.remove("selected"));
        this.classList.add("selected");
        selectedValue2 = parseFloat(this.value); 
        console.log(getSelectedValue2());
    });
});
function getSelectedValue2() {
    return selectedValue2;
}
const buttons3 = document.querySelectorAll(".b2");
buttons3.forEach(button => {
    button.addEventListener("click", function() {
        buttons3.forEach(btn => btn.classList.remove("selected"));
        this.classList.add("selected");
        selectedValue3 = parseFloat(this.value);  
        console.log(getSelectedValue3());
    });
});
function getSelectedValue3() {
    return selectedValue3;
}
const buttons4 = document.querySelectorAll(".b3");
buttons4.forEach(button => {
    button.addEventListener("click", function() {
        buttons4.forEach(btn => btn.classList.remove("selected"));
        this.classList.add("selected");
        selectedValue4 = parseFloat(this.value);  
        console.log(getSelectedValue4());
    });
});
function getSelectedValue4() {
    return selectedValue4;
}
const buttons5 = document.querySelectorAll(".b6");
buttons5.forEach(button => {
    button.addEventListener("click", function() {
        buttons5.forEach(btn => btn.classList.remove("selected"));
        this.classList.add("selected");
        selectedValue5 = parseFloat(this.value); 
        console.log(getSelectedValue5());
    });
});
function getSelectedValue5() {
    return selectedValue5;
}
document.getElementById("button-submit").addEventListener("click", function() {
    const in1 = parseFloat(document.getElementById("ii1").value);
    const in3 = parseFloat(document.getElementById("ii3").value);
    let ans = ((selectedValue1 + selectedValue2 + selectedValue3 + selectedValue4) * in3) * in1 + selectedValue5;
    console.log("Sum of selected values: " + ans);
    console.log("Input value: " + in1);
    document.getElementById("cl").innerHTML = `Total Cost: ${ans}`;
    document.getElementById("cl1").innerHTML=`Calculated Cost :${ans}`;
    localStorage.setItem('totalCost', ans);
});
document.getElementById('paper').addEventListener("click",function(){
    const selectElement = document.getElementById('paper');
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    selectedText = parseFloat(selectedOption.value);
    console.log(selectedText);
    document.getElementById("sh").innerHTML=`Shipping cost: ${selectedText}`;
    localStorage.setItem('shippingCost', selectedText);
})
document.getElementById("main-button").addEventListener("click",function(){
    window.location.href = 'cart.html';
})
document.getElementById("contact").addEventListener("click",function(){
    alert("Contact No : +91 9999999999");
    alert("email id: helpline@printzer.com");
})

