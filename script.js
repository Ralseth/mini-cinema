const authForm = document.querySelector('.auth-form');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');

registerLink.addEventListener(`click`, ()=> {
    authForm.classList.add('active');
});

loginLink.addEventListener(`click`, ()=> {
    authForm.classList.remove('active');
});

const iconClose = document.querySelector('.icon-close');
iconClose.addEventListener(`click`, ()=> {
    authForm.classList.remove('active-popup');
});


const cinema = document.querySelector('.cinema');

// Добавляем обработчик события на родительский элемент
cinema.addEventListener('click', function(event) {
  // Получаем целевой элемент (тот, на котором произошло событие)
  const target = event.target;

  // Проверяем, что целевой элемент имеет класс 'free-place'
  if (target.classList.contains('free-place')) {
    // Получаем значение атрибута data-id
    const dataId = target.getAttribute('data-id');
    
    // Получаем текущий массив ID из localStorage
    const ids = getSavedIds();

    // Проверяем, есть ли ID в массиве
    const index = ids.indexOf(dataId);
    if (index === -1) {
      // Если ID нет в массиве, добавляем его и добавляем класс
      ids.push(dataId);
      target.classList.add('selected'); // Добавляем класс
    } else {
      // Если ID есть в массиве, удаляем его и удаляем класс
      ids.splice(index, 1);
      target.classList.remove('selected'); // Удаляем класс
    }

    // Сохраняем обновленный массив в localStorage
    saveIds(ids);
  }
});
// Функция для получения массива из localStorage
function getSavedIds() {
    const savedIds = localStorage.getItem('selectedIds');
    return savedIds ? JSON.parse(savedIds) : [];
  }
  
  // Функция для сохранения массива в localStorage
  function saveIds(ids) {
    localStorage.setItem('selectedIds', JSON.stringify(ids));
  }
const sendId = document.querySelector('.send-id');
sendId.addEventListener('click', function(event) {
    const formData = new FormData();
    // Добавляем поле 'id' со значением '1'
    formData.append('ids', getSavedIds());

    fetch('script.php', {
        method: 'POST', // Указываем метод POST
        body: formData // Преобразуем данные в JSON
        })
        .then(response => response.text())
        .then(data => {
        console.log('Success:', data);
        localStorage.removeItem('selectedIds');
        })
        .catch(error => {
        console.error('Error:', error);
        });
});
  

