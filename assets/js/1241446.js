// MedControl - Mock Data e Utilitários JavaScript

// MOCK DATA
const mockData = {
    equipamentos: [
        { id: 1, codigo: 'EQ-001', nome: 'Ventilador Pulmonar', marca: 'Siemens', modelo: 'SERVO-i', localizacao: 'UCI-01', estado: 'Operacional', criticidade: 'Crítica' },
        { id: 2, codigo: 'EQ-002', nome: 'Monitor Cardíaco', marca: 'Philips', modelo: 'IntelliVue MP50', localizacao: 'Urgência', estado: 'Operacional', criticidade: 'Crítica' },
        { id: 3, codigo: 'EQ-003', nome: 'Bomba de Infusão', marca: 'Fresenius', modelo: 'Volumat Agilia', localizacao: 'UCI-02', estado: 'Operacional', criticidade: 'Alta' },
        { id: 4, codigo: 'EQ-004', nome: 'Desfibrilhador', marca: 'Zoll', modelo: 'X Series', localizacao: 'Bloco Operatório', estado: 'Operacional', criticidade: 'Crítica' },
        { id: 5, codigo: 'EQ-005', nome: 'Electrocardiograma', marca: 'GE Healthcare', modelo: 'MAC 5000', localizacao: 'Cardio', estado: 'Manutenção', criticidade: 'Alta' }
    ],
    localizacoes: [
        { id: 1, codigo: 'LOC-001', nome: 'UCI-01', tipo: 'Unidade', edicao: 'Principal', piso: '3' },
        { id: 2, codigo: 'LOC-002', nome: 'UCI-02', tipo: 'Unidade', edicao: 'Principal', piso: '3' },
        { id: 3, codigo: 'LOC-003', nome: 'Urgência', tipo: 'Serviço', edicao: 'Principal', piso: '0' },
        { id: 4, codigo: 'LOC-004', nome: 'Bloco Operatório', tipo: 'Serviço', edicao: 'Principal', piso: '2' },
        { id: 5, codigo: 'LOC-005', nome: 'Cardio', tipo: 'Serviço', edicao: 'Anexo', piso: '1' }
    ],
    fornecedores: [
        { id: 1, codigo: 'FORN-001', nome: 'Siemens Portugal', tipo: 'Fabricante', email: 'contato@siemens.pt', telefone: '+351 21 xxx xxxx' },
        { id: 2, codigo: 'FORN-002', nome: 'Philips Healthcare', tipo: 'Distribuidor', email: 'info@philips.pt', telefone: '+351 22 xxx xxxx' },
        { id: 3, codigo: 'FORN-003', nome: 'Fresenius Medical', tipo: 'Fabricante', email: 'sales@fresenius.pt', telefone: '+351 23 xxx xxxx' },
        { id: 4, codigo: 'FORN-004', nome: 'Zoll Assist', tipo: 'Assistência', email: 'support@zoll.pt', telefone: '+351 24 xxx xxxx' },
        { id: 5, codigo: 'FORN-005', nome: 'GE Healthcare Portugal', tipo: 'Distribuidor', email: 'contact@ge-healthcare.pt', telefone: '+351 25 xxx xxxx' }
    ],
    garantias: [
        { id: 1, equipamento: 'EQ-001', dataInicio: '2024-01-15', dataFim: '2027-01-15', status: 'Ativa', tipo: 'Fabricante' },
        { id: 2, equipamento: 'EQ-002', dataInicio: '2024-03-20', dataFim: '2025-03-20', status: 'Vence em 6 meses', tipo: 'Estendida' },
        { id: 3, equipamento: 'EQ-003', dataInicio: '2023-06-01', dataFim: '2025-06-01', status: 'Vence em 1 mês', tipo: 'Fabricante' },
        { id: 4, equipamento: 'EQ-004', dataInicio: '2024-02-10', dataFim: '2026-02-10', status: 'Ativa', tipo: 'Estendida' },
        { id: 5, equipamento: 'EQ-005', dataInicio: '2022-11-30', dataFim: '2025-11-30', status: 'Vence em 6 meses', tipo: 'Fabricante' }
    ]
};

// UTILITÁRIOS DE TABS
function initializeTabs(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const buttons = container.querySelectorAll('.tab-btn');
    const contents = container.querySelectorAll('.tab-content');

    buttons.forEach((button, index) => {
        button.addEventListener('click', () => {
            // Remove active de todos
            buttons.forEach(btn => btn.classList.remove('active'));
            contents.forEach(content => content.classList.remove('active'));

            // Ativa o clicado
            button.classList.add('active');
            contents[index].classList.add('active');
        });

        // Ativa o primeiro tab por padrão
        if (index === 0) {
            button.classList.add('active');
        }
    });

    // Ativa o primeiro conteúdo por padrão
    if (contents.length > 0) {
        contents[0].classList.add('active');
    }
}

// UTILITÁRIOS DE ACCORDION
function initializeAccordion(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const items = container.querySelectorAll('.accordion-item');

    items.forEach(item => {
        const header = item.querySelector('.accordion-header');

        header.addEventListener('click', () => {
            // Se já está ativo, desativa
            if (item.classList.contains('active')) {
                item.classList.remove('active');
            } else {
                // Fecha todos os outros
                items.forEach(otherItem => {
                    otherItem.classList.remove('active');
                });
                // Abre este
                item.classList.add('active');
            }
        });
    });
}

// VALIDAÇÃO DE FORMULÁRIOS
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;

    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.style.borderColor = '#e74c3c';
            isValid = false;
        } else {
            input.style.borderColor = '#ecf0f1';
        }
    });

    // Validar email
    const emailInputs = form.querySelectorAll('input[type="email"]');
    emailInputs.forEach(input => {
        if (input.value && !input.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            input.style.borderColor = '#e74c3c';
            isValid = false;
        }
    });

    return isValid;
}

// EXIBIR NOTIFICAÇÕES
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type}`;
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    notification.textContent = message;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// GRÁFICOS CANVAS - MOCK DATA
function drawPieChart(canvasId, label1, value1, label2, value2, label3, value3) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const radius = 80;

    const total = value1 + value2 + value3;
    let angle = -Math.PI / 2;

    // Desenhar fatias
    const colors = ['#4fc3f7', '#81d4fa', '#b3e5fc'];
    const values = [value1, value2, value3];

    values.forEach((value, index) => {
        const sliceAngle = (value / total) * 2 * Math.PI;

        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, angle, angle + sliceAngle);
        ctx.lineTo(centerX, centerY);
        ctx.fillStyle = colors[index];
        ctx.fill();
        ctx.strokeStyle = 'white';
        ctx.lineWidth = 2;
        ctx.stroke();

        angle += sliceAngle;
    });

    // Texto no centro
    ctx.fillStyle = '#0a2540';
    ctx.font = 'bold 14px Arial';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(total, centerX, centerY);
}

function drawBarChart(canvasId, labels, values, maxValue = null) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const padding = 40;
    const barWidth = (canvas.width - 2 * padding) / labels.length;
    const chartHeight = canvas.height - 2 * padding;

    if (!maxValue) maxValue = Math.max(...values) * 1.1;

    // Desenhar fundo branco
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Desenhar eixo X
    ctx.strokeStyle = '#ecf0f1';
    ctx.beginPath();
    ctx.moveTo(padding, canvas.height - padding);
    ctx.lineTo(canvas.width - padding, canvas.height - padding);
    ctx.stroke();

    // Desenhar eixo Y
    ctx.beginPath();
    ctx.moveTo(padding, padding);
    ctx.lineTo(padding, canvas.height - padding);
    ctx.stroke();

    // Desenhar barras
    ctx.fillStyle = '#4fc3f7';
    values.forEach((value, index) => {
        const barHeight = (value / maxValue) * chartHeight;
        const x = padding + index * barWidth + barWidth * 0.1;
        const y = canvas.height - padding - barHeight;
        const width = barWidth * 0.8;

        ctx.fillRect(x, y, width, barHeight);

        // Label
        ctx.fillStyle = '#0a2540';
        ctx.font = '12px Arial';
        ctx.textAlign = 'center';
        ctx.fillText(labels[index], x + width / 2, canvas.height - padding + 20);

        // Valor
        ctx.fillStyle = '#4fc3f7';
        ctx.fillText(value, x + width / 2, y - 5);
    });
}

function drawLineChart(canvasId, labels, values, maxValue = null) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const padding = 40;
    const pointRadius = 4;

    if (!maxValue) maxValue = Math.max(...values) * 1.1;

    // Desenhar fundo
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Desenhar grid
    ctx.strokeStyle = '#ecf0f1';
    ctx.beginPath();
    for (let i = 0; i <= 5; i++) {
        const y = padding + (i * (canvas.height - 2 * padding)) / 5;
        ctx.moveTo(padding, y);
        ctx.lineTo(canvas.width - padding, y);
    }
    ctx.stroke();

    // Desenhar linha
    const pointSpacing = (canvas.width - 2 * padding) / (labels.length - 1 || 1);
    ctx.strokeStyle = '#4fc3f7';
    ctx.lineWidth = 2;
    ctx.beginPath();

    values.forEach((value, index) => {
        const x = padding + index * pointSpacing;
        const y = canvas.height - padding - (value / maxValue) * (canvas.height - 2 * padding);

        if (index === 0) {
            ctx.moveTo(x, y);
        } else {
            ctx.lineTo(x, y);
        }
    });
    ctx.stroke();

    // Desenhar pontos
    ctx.fillStyle = '#4fc3f7';
    values.forEach((value, index) => {
        const x = padding + index * pointSpacing;
        const y = canvas.height - padding - (value / maxValue) * (canvas.height - 2 * padding);

        ctx.beginPath();
        ctx.arc(x, y, pointRadius, 0, 2 * Math.PI);
        ctx.fill();
    });

    // Labels
    ctx.fillStyle = '#0a2540';
    ctx.font = '12px Arial';
    ctx.textAlign = 'center';
    labels.forEach((label, index) => {
        const x = padding + index * pointSpacing;
        ctx.fillText(label, x, canvas.height - padding + 20);
    });
}

// PESQUISA E FILTROS
function filterTable(tableId, searchInputId) {
    const searchInput = document.getElementById(searchInputId);
    if (!searchInput) return;

    const table = document.getElementById(tableId);
    const rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('keyup', (e) => {
        const searchTerm = e.target.value.toLowerCase();

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
}

// PAGINAÇÃO SIMPLES
function paginateTable(tableId, rowsPerPage = 10) {
    const table = document.getElementById(tableId);
    if (!table) return;

    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    let currentPage = 1;

    const showPage = (page) => {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach((row, index) => {
            row.style.display = (index >= start && index < end) ? '' : 'none';
        });
    };

    // Mostrar primeira página
    showPage(currentPage);

    // Criar controles de paginação
    const paginationDiv = document.createElement('div');
    paginationDiv.style.textAlign = 'center';
    paginationDiv.style.marginTop = '20px';

    for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement('button');
        btn.textContent = i;
        btn.style.padding = '8px 12px';
        btn.style.margin = '5px';
        btn.style.borderRadius = '4px';
        btn.style.border = i === currentPage ? '2px solid #4fc3f7' : '1px solid #ecf0f1';
        btn.style.background = i === currentPage ? '#4fc3f7' : 'white';
        btn.style.color = i === currentPage ? 'white' : '#0a2540';
        btn.style.cursor = 'pointer';

        btn.addEventListener('click', () => {
            currentPage = i;
            showPage(i);
            document.querySelectorAll('[data-pagination-btn]').forEach((b, idx) => {
                b.style.border = (idx + 1) === i ? '2px solid #4fc3f7' : '1px solid #ecf0f1';
                b.style.background = (idx + 1) === i ? '#4fc3f7' : 'white';
                b.style.color = (idx + 1) === i ? 'white' : '#0a2540';
            });
        });

        btn.setAttribute('data-pagination-btn', 'true');
        paginationDiv.appendChild(btn);
    }

    table.parentElement.insertAdjacentElement('afterend', paginationDiv);
}

// EXPORTAR PARA CSV
function exportTableToCSV(tableId, filename = 'export.csv') {
    const table = document.getElementById(tableId);
    if (!table) return;

    let csv = [];
    const rows = table.querySelectorAll('tr');

    rows.forEach(row => {
        const cols = row.querySelectorAll('td, th');
        const csvRow = [];
        cols.forEach(col => csvRow.push('"' + col.textContent + '"'));
        csv.push(csvRow.join(','));
    });

    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    link.click();
}

// MODAIS
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.add('active');
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.remove('active');
}

// Inicializar ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
    // Inicializar todos os tabs
    document.querySelectorAll('[id*="tabs"]').forEach(el => {
        initializeTabs(el.id);
    });

    // Inicializar todos os accordions
    document.querySelectorAll('[id*="accordion"]').forEach(el => {
        initializeAccordion(el.id);
    });

    // Fechar modais ao clicar no botão de fechar
    document.querySelectorAll('.modal-close').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const modal = e.target.closest('.modal');
            if (modal) modal.classList.remove('active');
        });
    });

    // Fechar modais ao clicar fora
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.remove('active');
        });
    });
});
