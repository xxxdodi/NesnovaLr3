import Api from '@/api/index';

class Subjects extends Api {

  /**
   * Вернет список всех предметов
   * @returns {Promise<Response>}
   */
  subjects = () => this.rest('/subjects/list.json');

  /**
   * Удалит предмет по id
   * @param id
   * @returns {Promise<*>}
   */
  remove = ( id ) => this.rest('/subjects/delete-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify({ id }),
  }).then(() => id) // then - заглушка, пока метод ничего не возвращает

  /**
   * Создаст новую запись в таблице
   * @param subject объект предмета, взятый из FormSubject
   * @returns {Promise<Response>}
   */
  add = ( subject ) => this.rest('/subjects/add-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(subject),
  }).then(() => ({...subject, id: new Date().getTime()})) // then - заглушка, пока метод ничего не возвращает

  /**
   * Отправит измененную запись
   * @param subject объект предмета, взятый из FormSubject
   * @returns {Promise<*>}
   */
  update = ( subject ) => this.rest('/subjects/update-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(subject),
  }).then(() => subject) // then - заглушка, пока метод ничего не возвращает

}

export default new Subjects();
