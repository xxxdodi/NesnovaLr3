import Api from '@/api/index';

class SubjectsFiltred extends Api {

  /**
   * Вернет список всех предметов
   * @returns {Promise<Response>}
   */
  subjectsfiltred = () => this.rest('/subjectsfiltred/list-filtred.json');

  /**
   * Удалит предмет по id
   * @param id
   * @returns {Promise<*>}
   */
  remove = ( id ) => this.rest('/subjectsfiltred/delete-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify({ id }),
  }).then(() => id) // then - заглушка, пока метод ничего не возвращает

  /**
   * Создаст новую запись в таблице
   * @param subject объект предмета, взятый из FormSubject
   * @returns {Promise<Response>}
   */
  add = ( subject ) => this.rest('/subjectsfiltred/add-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(subject),
  }).then(() => ({...subject, id: new Date().getTime()})) // then - заглушка, пока метод ничего не возвращает

  /**
   * Отправит измененную запись
   * @param subject объект предмета, взятый из FormSubject
   * @returns {Promise<*>}
   */
  update = ( subject ) => this.rest('/subjectsfiltred/update-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(subject),
  }).then(() => subject) // then - заглушка, пока метод ничего не возвращает

}

export default new SubjectsFiltred();
