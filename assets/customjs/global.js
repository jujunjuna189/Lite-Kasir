const setZeroNumber = (number) => {
    number = number < 10 ? '0' + number : number;
    return number;
}