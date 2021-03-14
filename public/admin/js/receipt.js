getValue = (e) => {
    e.preventDefault();
    let flag = true
    let day = document.forms['formTextbox'].day.value
    let month = document.forms['formTextbox'].month.value
    let year = document.forms['formTextbox'].year.value
    if (day.toString().length < 0 || day > 31 || day.toString().length > 2)
        flag = false
    if (month.toString().length < 0 || month > 13 || month.toString().length > 2)
        flag = false
    if (year.toString().length <= 0 || year > new Date().getFullYear().toString() || year.toString().length > 4)
        flag = false
    if(flag){
        console.log(day,month,year)
    }
}