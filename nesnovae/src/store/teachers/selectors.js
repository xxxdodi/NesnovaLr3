export const fetchItems = ( store ) => {
  const { dispatch } = store;
  dispatch('teachers/fetchItems');
};

export const selectItems = ( store ) => {
  const { getters } = store;
  return getters['teachers/items']
}

export const removeItem = ( store, id ) => {
  const { dispatch } = store;
  dispatch('teachers/removeItem', id);
}

export const addItem = ( store, { teacher, department } ) => {
  const { dispatch } = store;
  dispatch('teachers/addItem', { teacher, department });
}

export const updateItem = ( store, { id, teacher, department }) => {
  const { dispatch } = store;
  dispatch('teachers/updateItem', { id, teacher, department });
}

export const selectItemById = (store, id) => {
  const { getters } = store;
  return getters['teachers/itemsByKey'][id] || {};
}
