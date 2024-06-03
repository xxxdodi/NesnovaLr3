export const fetchItems = (store) => {
  const { dispatch } = store;
  dispatch('subjectsfiltred/fetchItems');
};

export const selectItems = (store) => {
  const { getters } = store;
  return getters['subjectsfiltred/items']
}

export const removeItem = (store, id) => {
  const { dispatch } = store;
  dispatch('subjectsfiltred/removeItem', id);
}

export const addItem = (store, { subject, description, hours, teacher }) => {
  const { dispatch } = store;
  dispatch('subjectsfiltred/addItem', { subject, description, hours, teacher });
}

export const updateItem = (store, { id, subject, description, hours, teacher }) => {
  const { dispatch } = store;
  dispatch('subjectsfiltred/updateItem', { id, subject, description, hours, teacher });
}

export const selectItemById = (store, id) => {
  const { getters } = store;
  return getters['subjectsfiltred/itemsByKey'][id] || {};
}
