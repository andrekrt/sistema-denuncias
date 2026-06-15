import "./bootstrap";

import Alpine from "alpinejs";
import Swal from "sweetalert2";

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

window.addEventListener("load", () => {
    const flash = window.flashMessages || {};

    if (flash.success) {
        Swal.fire({
            icon: "success",
            title: "Sucesso!",
            text: flash.success,
            confirmButtonText: "OK",
            confirmButtonColor: "#7f1d1d",
        });
    }

    if (flash.error) {
        Swal.fire({
            icon: "error",
            title: "Atenção!",
            text: flash.error,
            confirmButtonText: "OK",
            confirmButtonColor: "#7f1d1d",
        });
    }

    if (flash.status) {
        Swal.fire({
            icon: "success",
            title: "Tudo certo!",
            text: flash.status,
            confirmButtonText: "OK",
            confirmButtonColor: "#7f1d1d",
        });
    }

    if (flash.validationError) {
        Swal.fire({
            icon: "error",
            title: "Não foi possível entrar",
            text: flash.validationError,
            confirmButtonText: "OK",
            confirmButtonColor: "#7f1d1d",
        });
    }
});

document.addEventListener("submit", (event) => {
    const form = event.target;

    if (!form.classList.contains("js-confirm-status")) {
        return;
    }

    event.preventDefault();

    Swal.fire({
        icon: "question",
        title: "Confirmar alteração?",
        text: "Deseja realmente alterar o status desta denúncia?",
        showCancelButton: true,
        confirmButtonText: "Sim, alterar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#7f1d1d",
        cancelButtonColor: "#64748b",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

document.addEventListener("submit", (event) => {
    const form = event.target;

    if (!form.classList.contains("js-confirm-visible-message")) {
        return;
    }

    const checkbox = form.querySelector('input[name="visivel_denunciante"]');

    if (!checkbox || !checkbox.checked) {
        return;
    }

    event.preventDefault();

    Swal.fire({
        icon: "warning",
        title: "Mensagem visível ao denunciante",
        text: "Essa mensagem aparecerá na tela pública de acompanhamento. Deseja continuar?",
        showCancelButton: true,
        confirmButtonText: "Sim, enviar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#7f1d1d",
        cancelButtonColor: "#64748b",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

document.addEventListener("submit", (event) => {
    const form = event.target;

    if (!form.classList.contains("js-confirm-public-denuncia")) {
        return;
    }

    const inputAnexos = form.querySelector("#anexos");

    if (inputAnexos) {
        const arquivos = Array.from(inputAnexos.files || []);
        const passouQuantidade = arquivos.length > 5;
        const passouTamanho = arquivos.some(
            (arquivo) => arquivo.size > 5 * 1024 * 1024,
        );

        if (passouQuantidade || passouTamanho) {
            return;
        }
    }

    event.preventDefault();

    Swal.fire({
        icon: "warning",
        title: "Confirmar envio?",
        html: `
            <div style="text-align: left">
                <p>Após enviar, será gerado um <strong>protocolo</strong> e uma <strong>senha de acompanhamento</strong>.</p>
                <p style="margin-top: 10px">Guarde essas informações com segurança, pois a senha será exibida apenas uma vez.</p>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: "Sim, registrar denúncia",
        cancelButtonText: "Revisar formulário",
        confirmButtonColor: "#7f1d1d",
        cancelButtonColor: "#64748b",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

const configurarDenunciaAnonima = () => {
    const checkbox = document.getElementById("anonima");
    const camposIdentificacao = document.getElementById("campos-identificacao");
    const avisoAnonima = document.getElementById("aviso-anonima");

    if (!checkbox || !camposIdentificacao || !avisoAnonima) {
        return;
    }

    const inputsIdentificacao = camposIdentificacao.querySelectorAll("input");

    const atualizarVisibilidade = () => {
        if (checkbox.checked) {
            camposIdentificacao.classList.add("hidden");
            avisoAnonima.classList.remove("hidden");

            inputsIdentificacao.forEach((input) => {
                input.value = "";
            });

            return;
        }

        camposIdentificacao.classList.remove("hidden");
        avisoAnonima.classList.add("hidden");
    };

    atualizarVisibilidade();

    checkbox.addEventListener("change", atualizarVisibilidade);
};

document.addEventListener("DOMContentLoaded", configurarDenunciaAnonima);

const configurarContadorDescricao = () => {
    const descricao = document.getElementById("descricao");
    const contador = document.getElementById("contador-descricao");

    if (!descricao || !contador) {
        return;
    }

    const minimo = 20;

    const atualizarContador = () => {
        const total = descricao.value.trim().length;

        contador.textContent = `${total}/${minimo}`;

        if (total >= minimo) {
            contador.classList.remove("text-red-700", "text-slate-500");
            contador.classList.add("text-green-700");
            return;
        }

        contador.classList.remove("text-green-700", "text-slate-500");
        contador.classList.add("text-red-700");
    };

    atualizarContador();

    descricao.addEventListener("input", atualizarContador);
};

document.addEventListener("DOMContentLoaded", configurarContadorDescricao);

const configurarAnexos = () => {
    const input = document.getElementById("anexos");
    const info = document.getElementById("info-anexos");

    if (!input || !info) {
        return;
    }

    const limiteArquivos = 5;
    const limiteMb = 5;

    const formatarTamanho = (bytes) => {
        const mb = bytes / 1024 / 1024;

        if (mb >= 1) {
            return `${mb.toFixed(2).replace(".", ",")} MB`;
        }

        return `${(bytes / 1024).toFixed(1).replace(".", ",")} KB`;
    };

    const atualizarInfo = () => {
        const arquivos = Array.from(input.files || []);

        if (!arquivos.length) {
            info.classList.add("hidden");
            info.innerHTML = "Nenhum arquivo selecionado.";
            return;
        }

        info.classList.remove("hidden");

        const passouQuantidade = arquivos.length > limiteArquivos;
        const passouTamanho = arquivos.some(
            (arquivo) => arquivo.size > limiteMb * 1024 * 1024,
        );

        const lista = arquivos
            .map(
                (arquivo) =>
                    `<li>${arquivo.name} — ${formatarTamanho(arquivo.size)}</li>`,
            )
            .join("");

        let aviso = "";

        if (passouQuantidade) {
            aviso += `<p class="mb-2 font-semibold text-red-700">Você selecionou ${arquivos.length} arquivos. O máximo permitido é ${limiteArquivos}.</p>`;
        }

        if (passouTamanho) {
            aviso += `<p class="mb-2 font-semibold text-red-700">Um ou mais arquivos ultrapassam ${limiteMb} MB.</p>`;
        }

        info.innerHTML = `
            ${aviso}
            <p class="font-semibold text-slate-900">${arquivos.length} arquivo(s) selecionado(s):</p>
            <ul class="mt-2 list-disc list-inside space-y-1">${lista}</ul>
        `;

        if (passouQuantidade || passouTamanho) {
            info.classList.remove(
                "border-slate-200",
                "bg-slate-50",
                "text-slate-700",
            );
            info.classList.add("border-red-200", "bg-red-50", "text-red-800");
            return;
        }

        info.classList.remove("border-red-200", "bg-red-50", "text-red-800");
        info.classList.add("border-slate-200", "bg-slate-50", "text-slate-700");
    };

    input.addEventListener("change", atualizarInfo);

    const form = input.closest("form");

    if (form) {
        form.addEventListener("submit", (event) => {
            const arquivos = Array.from(input.files || []);
            const passouQuantidade = arquivos.length > limiteArquivos;
            const passouTamanho = arquivos.some(
                (arquivo) => arquivo.size > limiteMb * 1024 * 1024,
            );

            if (!passouQuantidade && !passouTamanho) {
                return;
            }

            event.preventDefault();

            Swal.fire({
                icon: "error",
                title: "Verifique os anexos",
                text: `Envie no máximo ${limiteArquivos} arquivos, com até ${limiteMb} MB cada.`,
                confirmButtonText: "OK",
                confirmButtonColor: "#7f1d1d",
            });
        });
    }
};

document.addEventListener("DOMContentLoaded", configurarAnexos);
