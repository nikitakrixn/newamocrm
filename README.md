## AMOCRM
В разделе амоМаркет в правом верхнем нажать кнопку "+ WEB HOOKS". Выбрать отправку хуков для событий "Сделка добавлена", "Контакт добавлен", "Сделка изменена", "Контакт изменен". В URL прописать адрес скрипта, который необходимо разработать.
Скрипт должен выполнять следующее: добавлять текстовое примечание в карточке, по которой был получен хук. Если получен хук на создание карточки, то текстовое примечание должно содержать название сделки/контакта, ответственного и время добавления карточки. Если получен хук на изменение карточки, то текстовое примечание должно содержать названия и новые значения измененных полей, время изменения карточки.
