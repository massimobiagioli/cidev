// Gestione selezione row
export const dataGridHandleRowSelect = (gridId, data) => {
    return {
        type: 'dataGridHandleRowSelect',
        gridId: gridId,
        data: data
    }
}; 

// Gestione deselezione row
export const dataGridHandleRowUnselect = (gridId, data) => {
    return {
        type: 'dataGridHandleRowUnselect',
        gridId: gridId,
        data: data
    }
}; 