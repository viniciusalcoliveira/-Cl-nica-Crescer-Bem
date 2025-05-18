const form = document.getElementById('multiStepForm');
let currentStep = 0;
const steps = document.querySelectorAll('.step');
const indicators = document.querySelectorAll('.progress-step');
const tipoSelect = document.getElementById('tipo');

// Etapas do formulário
function showStep(index) {
  const tipo = tipoSelect.value;
  const isProf = tipo === 'profissional';

  steps.forEach((step, i) => {
    const isStepProf = step.classList.contains('profissional-only');
    const skipProfStep = !isProf && isStepProf;
    step.classList.toggle('active', i === index && !skipProfStep);
    if (indicators[i]) {
      indicators[i].classList.toggle('active', i <= index && (isProf || !indicators[i].classList.contains('profissional-only')));
    }
  });
}

function validateStep() {
  const inputs = steps[currentStep].querySelectorAll('input, select, textarea');
  for (let input of inputs) {
    if (input.offsetParent !== null && input.required && input.value.trim() === '') {
      input.classList.add('error');
      alert('Preencha todos os campos obrigatórios.');
      return false;
    }
    input.classList.remove('error');
  }
  return true;
}

function nextStep() {
  if (!validateStep()) return;

  const tipo = tipoSelect.value;
  const isProf = tipo === 'profissional';

  if (!isProf && currentStep === 2) {
    form.dispatchEvent(new Event('submit'));
    return;
  }

  if (currentStep < steps.length - 1) {
    currentStep++;
    showStep(currentStep);
  }
}

function prevStep() {
  if (currentStep > 0) {
    currentStep--;
    showStep(currentStep);
  }
}

// Atualizar campos com base no tipo de usuário
tipoSelect.addEventListener('change', () => {
  const tipo = tipoSelect.value;
  const isProf = tipo === 'profissional';

  // Exibe/oculta passo de profissional
  document.querySelectorAll('.step.profissional-only').forEach(div => {
    div.style.display = isProf ? 'flex' : 'none';
  });

  // Campo de filho
  const filhoGroup = document.getElementById('nomeFilhoGroup');
  if (filhoGroup) filhoGroup.style.display = isProf ? 'none' : 'block';

  showStep(currentStep);
});

document.addEventListener('DOMContentLoaded', () => {
  tipoSelect.dispatchEvent(new Event('change'));

  // Exibir/ocultar horários conforme checkbox
  document.querySelectorAll('.dia-checkbox').forEach(checkbox => {
    const dia = checkbox.dataset.dia;
    const bloco = document.getElementById(`horario-${dia}`);
    if (bloco) {
      bloco.style.display = checkbox.checked ? 'flex' : 'none';
      checkbox.addEventListener('change', () => {
        bloco.style.display = checkbox.checked ? 'flex' : 'none';
      });
    }
  });
});

// Toast de sucesso/erro
function showToast(message, type = 'success') {
  const toast = document.getElementById('toast');
  toast.textContent = message;
  toast.className = `toast ${type}`;
  toast.classList.remove('hidden');
  setTimeout(() => {
    toast.classList.add('hidden');
  }, 4000);
}

// Enviar dados para o PHP via fetch
form.addEventListener('submit', async function (e) {
  e.preventDefault();

  const senha = document.getElementById('senha').value;
  const confirmar = document.getElementById('confirmar_senha').value;
  if (senha !== confirmar) {
    showToast("As senhas não coincidem!", "error");
    return;
  }

  const formData = new FormData(form);
  try {
    const response = await fetch('../backend/cadastro.php', {
      method: 'POST',
      body: formData
    });
    const result = await response.json();

    if (result.status === 'success') {
      showToast("Cadastro realizado com sucesso!", "success");
      form.reset();
      currentStep = 0;
      showStep(currentStep);
    } else {
      showToast(result.message || "Erro ao cadastrar!", "error");
    }
  } catch (err) {
    showToast("Erro de conexão com o servidor!", "error");
  }
});
