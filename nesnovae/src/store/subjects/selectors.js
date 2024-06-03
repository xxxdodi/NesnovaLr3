export const fetchItems = (store) => {
  const { dispatch } = store;
  dispatch('subjects/fetchItems');
};

export const selectItems = (store) => {
  const { getters } = store;
  return getters['subjects/items']
}

export const removeItem = (store, id) => {
  const { dispatch } = store;
  dispatch('subjects/removeItem', id);
}

export const addItem = (store, { subject, description, hours, teacher }) => {
  const { dispatch } = store;
  dispatch('subjects/addItem', { subject, description, hours, teacher });
}

export const updateItem = (store, { id, subject, description, hours, teacher }) => {
  const { dispatch } = store;
  dispatch('subjects/updateItem', { id, subject, description, hours, teacher });
}

export const selectItemById = (store, id) => {
  const { getters } = store;
  return getters['subjects/itemsByKey'][id] || {};
}
