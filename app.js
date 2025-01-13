const secondsContainer = document.querySelector('#seconds')
const minutesContainer = document.querySelector('#minutes')
const hoursContainer = document.querySelector('#hours')
const daysContainer = document.querySelector('#days')

const nextYear = new Date().getFullYear() 
const newYearTime = new Date(`March 11 ${nextYear} 20:30:00`)

const updateCountdown = () => {
    const currentTime = new Date()
    const difference = newYearTime - currentTime
    const days = Math.floor(difference / 1000 / 60 / 60 / 24)
    const hours = Math.floor(difference / 1000 / 60 / 60 ) %24
    const minutes = Math.floor(difference / 1000 / 60 ) %60
    const seconds = Math.floor(difference / 1000 ) %60

    secondsContainer.textContent = seconds < 10 ? '0' + seconds + ' segundos' : seconds + ' segundos'
    minutesContainer.textContent = minutes < 10 ? '0' + minutes + ' minutos' : minutes + ' minutos'
    hoursContainer.textContent = hours < 10 ? '0' + hours + ' horas ' : hours + ' horas'
    daysContainer.textContent = days < 10 ? '0' + days + ' dias ' : days + ' dias'
    
}

setInterval(updateCountdown, 1000)

let form = document.querySelector('#presenca')

function desativaOpcao() {
    let select = document.querySelector('#convidado')
    let posicao = select.options['selectedIndex']
    select.options[posicao].disabled = true
}

// adicione um manipulador de evento submit ao formulário
form.addEventListener("submit", function (event) {
  // previna o envio padrão do formulário
  event.preventDefault();

  console.log('estamos aqui')
});