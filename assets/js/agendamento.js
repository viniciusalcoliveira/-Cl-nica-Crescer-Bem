document.addEventListener('DOMContentLoaded', () => {
  const nome = localStorage.getItem('usuario_nome') || '';
  const email = localStorage.getItem('usuario_email') || '';
  document.getElementById('nome').value = nome;
  document.getElementById('email').value = email;

  document.getElementById('servico').addEventListener('change', carregarProfissionais);
  document.getElementById('profissional_id').addEventListener('change', carregarHorarios);
  document.getElementById('data').addEventListener('change', carregarHorarios);

  exibirNotificacao();
});

function carregarProfissionais() {
  const servico = document.getElementById('servico').value.trim();
  const profSelect = document.getElementById('profissional_id');
  const horaSelect = document.getElementById('hora');

  profSelect.innerHTML = '<option value="">Carregando profissionais...</option>';
  horaSelect.innerHTML = '<option value="">Selecione um profissional</option>';

  if (!servico) {
    profSelect.innerHTML = '<option value="">Selecione um serviço primeiro</option>';
    return;
  }

  fetch(`../backend/get_profissionais.php?servico=${encodeURIComponent(servico)}`)
    .then(res => res.json())
    .then(data => {
      if (data.length > 0) {
        profSelect.innerHTML = '<option value="">Selecione um profissional</option>';
        data.forEach(p => {
          const opt = document.createElement('option');
          opt.value = p.id;
          opt.textContent = p.nome;
          profSelect.appendChild(opt);
        });
      } else {
        profSelect.innerHTML = '<option value="">Nenhum profissional encontrado</option>';
      }
    })
    .catch(() => {
      profSelect.innerHTML = '<option value="">Erro ao carregar profissionais</option>';
    });
}

function carregarHorarios() {
  const profissional = document.getElementById('profissional_id').value;
  const data = document.getElementById('data').value;
  const horaSelect = document.getElementById('hora');

  if (profissional && data) {
    horaSelect.innerHTML = '<option value="">Carregando horários...</option>';
    fetch(`../backend/horarios_disponiveis.php?profissional_id=${profissional}&data=${data}`)
      .then(res => res.json())
      .then(data => {
        horaSelect.innerHTML = '<option value="">Selecione um horário</option>';
        if (data.length > 0) {
          data.forEach(hora => {
            const opt = document.createElement('option');
            opt.value = hora;
            opt.textContent = hora;
            horaSelect.appendChild(opt);
          });
        } else {
          horaSelect.innerHTML = '<option value="">Sem horários disponíveis</option>';
        }
      })
      .catch(() => {
        horaSelect.innerHTML = '<option value="">Erro ao carregar horários</option>';
      });
  }
}

function exibirNotificacao() {
  const params = new URLSearchParams(window.location.search);
  const status = params.get('status');
  const notificacao = document.getElementById('notificacao');

  if (!status || !notificacao) return;

  notificacao.classList.remove('hidden', 'erro', 'sucesso');

  if (status === 'sucesso') {
    notificacao.textContent = '✅ Agendamento realizado com sucesso!';
    notificacao.classList.add('sucesso');
  } else if (status === 'conflito') {
    notificacao.textContent = '⚠️ Este horário já foi agendado. Tente outro.';
    notificacao.classList.add('erro');
  } else {
    notificacao.textContent = '❌ Erro ao realizar o agendamento. Tente novamente.';
    notificacao.classList.add('erro');
  }

  setTimeout(() => {
    notificacao.classList.add('hidden');
    notificacao.classList.remove('erro', 'sucesso');
  }, 5000);
}
