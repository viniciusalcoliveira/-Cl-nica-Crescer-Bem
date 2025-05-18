document.addEventListener('DOMContentLoaded', () => {
  const especialidadeSelect = document.getElementById('especialidade');
  const extraFields = document.getElementById('extra-fields');

  especialidadeSelect.addEventListener('change', () => {
    const selected = especialidadeSelect.value;
    extraFields.innerHTML = '';

    if (selected === 'Psicologia') {
      extraFields.innerHTML = '<label>Escala de humor inicial: <input type="text" name="escala_humor"></label>';
    } else if (selected === 'Fonoaudiologia') {
      extraFields.innerHTML = '<label>Problema de fala detectado: <input type="text" name="fala"></label>';
    }
  });
});