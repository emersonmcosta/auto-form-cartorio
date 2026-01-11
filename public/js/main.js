(function($) {



	// ---- FUNÇÕES AUXILIARES ----
	function randomString(length = 10) {
		const chars = "abcdefghijklmnopqrstuvwxyz ";
		let str = "";
		for (let i = 0; i < length; i++) str += chars[Math.floor(Math.random() * chars.length)];
		return str.charAt(0).toUpperCase() + str.slice(1);
	}

	function randomNumber(min = 1, max = 9999) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}

	function randomDate(start = 1990, end = 2024) {
		const date = new Date(start + Math.random() * (end - start), Math.random() * 12, Math.random() * 28);
		return date.toISOString().split("T")[0];
	}

	function randomTime() {
		const h = String(Math.floor(Math.random() * 23)).padStart(2, "0");
		const m = String(Math.floor(Math.random() * 59)).padStart(2, "0");
		return `${h}:${m}`;
	}

	function randomCPF() {
		return `${randomNumber(100,999)}.${randomNumber(100,999)}.${randomNumber(100,999)}-${randomNumber(10,99)}`;
	}

	// ---- PRINCIPAL ----
	function preencherDadosFake() {
		const campos = document.querySelectorAll('input[data-request="true"], textarea[data-request="true"], select[data-request="true"]');

		campos.forEach(campo => {
			const type = campo.type;

			if (campo.classList.contains("cpf_cnpj")) {
				campo.value = randomCPF();
				return;
			}

			switch (type) {
				case "text":
					campo.value = randomString(12);
					break;

				case "number":
					campo.value = randomNumber(1, 100);
					break;

				case "date":
					campo.value = randomDate();
					break;

				case "time":
					campo.value = randomTime();
					break;

				case "email":
					campo.value = randomString(6) + "@teste.com";
					break;

				default:
					if (campo.tagName === "TEXTAREA") {
						campo.value = randomString(40);
					} else {
						campo.value = randomString(10);
					}
			}
		});
	}

	// ---- DISPARAR SOMENTE SE URL TIVER ?teste=true ----
	(function() {
		const params = new URLSearchParams(window.location.search);
		if (params.get("teste") === "true") {
			preencherDadosFake();
		}
	})();


	"use strict";

	$(window).on('load', function() {
		$('.ftco-section').fadeIn(500);
	});

	$(".cpf_cnpj").keydown(function(){
		try {
			$(".cpf_cnpj").unmask();
		} catch (e) {}

		var tamanho = $(".cpf_cnpj").val().length;

		if(tamanho < 11){
			$(".cpf_cnpj").mask("999.999.999-99");
		} else {
			$(".cpf_cnpj").mask("99.999.999/9999-99");
		}

		// ajustando foco
		var elem = this;
		setTimeout(function(){
			// mudo a posição do seletor
			elem.selectionStart = elem.selectionEnd = 10000;
		}, 0);
		// reaplico o valor para mudar o foco
		var currentValue = $(this).val();
		$(this).val('');
		$(this).val(currentValue);
	});


	$(".cpf").keydown(function(){
		try {
			$(".cpf").unmask();
		} catch (e) {}

		var tamanho = $(".cpf").val().length;

		$(".cpf").mask("999.999.999-99");

		// ajustando foco
		var elem = this;
		setTimeout(function(){
			// mudo a posição do seletor
			elem.selectionStart = elem.selectionEnd = 10000;
		}, 0);
		// reaplico o valor para mudar o foco
		var currentValue = $(this).val();
		$(this).val('');
		$(this).val(currentValue);
	});


$(document).on('click', '#BtnFormDocument', function (e) {
    e.preventDefault();

    let formValid = true;
    const $form = $('#formDocument');

    // 1️⃣ Validação dos campos obrigatórios
    $form.find('[data-request="true"]').each(function () {
        if ($(this).val().trim() === '') {
            formValid = false;

            let labelText = $('label[for="' + $(this).attr('id') + '"]').text().trim();

            if (!labelText) {
                labelText = $(this).prev('label').text().trim();
            }

            if (!labelText) {
                labelText = $(this).attr('placeholder') || 'este campo';
            }

            Swal.fire('Erro', `O campo "${labelText}" é obrigatório.`, 'error');
            return false;
        }
    });

    // ❌ Se inválido, cancela
    if (!formValid) return;

    // 3️⃣ Desabilitar botão
    $('#BtnFormDocument').prop('disabled', true).text('Aguarde...');

    // 4️⃣ Criar FormData (AGORA com datas corrigidas)
    let formData = new FormData($form[0]);
    let url = $('#BtnFormDocument').attr('actionRoute');

    // 5️⃣ Enviar via AJAX
    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        xhrFields: {
            responseType: 'blob'
        },
        success: function (response, status, xhr) {
            const disposition = xhr.getResponseHeader('Content-Disposition');
            const contentType = xhr.getResponseHeader('Content-Type');

            let extension = 'docx';
            if (contentType === 'application/pdf') {
                extension = 'pdf';
            }

            const blob = new Blob([response], { type: contentType });
            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = `arquivo_gerado.${extension}`;
            link.click();

            Swal.fire({
                title: 'Sucesso!',
                text: 'Documento gerado com sucesso.',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false
            }).then(() => window.location.href = '/');
        },
        error: function (xhr) {
            $('#BtnFormDocument').prop('disabled', false).text('GERAR DOCUMENTO');

            let message = 'Ocorreu um erro.';
            try {
                const json = JSON.parse(xhr.responseText);
                message = json.error || message;
            } catch (e) {
                if (xhr.responseText) message = xhr.responseText;
            }

            Swal.fire('Erro', message, 'error');
        }
    });
});



  // Form
	var contactForm = function() {
		if ($('#contactForm').length > 0 ) {
			$( "#contactForm" ).validate( {
				rules: {
					name: "required",
					subject: "required",
					email: {
						required: true,
						email: true
					},
					message: {
						required: true,
						minlength: 5
					}
				},
				messages: {
					name: "Please enter your name",
					subject: "Please enter your subject",
					email: "Please enter a valid email address",
					message: "Please enter a message"
				},
				/* submit via ajax */
				
				submitHandler: function(form) {		
					var $submit = $('.submitting'),
						waitText = 'Submitting...';

					$.ajax({   	
				      type: "POST",
				      url: "php/sendEmail.php",
				      data: $(form).serialize(),

				      beforeSend: function() { 
				      	$submit.css('display', 'block').text(waitText);
				      },
				      success: function(msg) {
		               if (msg == 'OK') {
		               	$('#form-message-warning').hide();
				            setTimeout(function(){
		               		$('#contactForm').fadeOut();
		               	}, 1000);
				            setTimeout(function(){
				               $('#form-message-success').fadeIn();   
		               	}, 1400);
		               	setTimeout(function(){
				               $submit.css('display', 'none').text(waitText);  
		               	}, 1400);
			               
			            } else {
			               $('#form-message-warning').html(msg);
				            $('#form-message-warning').fadeIn();
				            $submit.css('display', 'none');
			            }
				      },
				      error: function() {
				      	$('#form-message-warning').html("Something went wrong. Please try again.");
				         $('#form-message-warning').fadeIn();
				         $submit.css('display', 'none');
				      }
			      });    		
		  		} // end submitHandler

			});
		}
	};
	contactForm();

	$(function() {
    	$('#hora_assembleia, #horario_segunda_convocacao, #hora_fim').mask('00:00');
    });
    $('#cnpj_condominio').mask('00.000.000/0000-00');
    $('#data_assembleia').mask('00/00/0000');

})(jQuery);

        function loading(value) {
            console.log('chamou loading passando: ',value   )
            if (value)
                $('#modal-loading').modal('show');
            else
                $('#modal-loading').modal('hide');
        }

        function mensagem(classe, mensagem) {
            $('#mensagem').removeClass('border-success border-warning border-danger');
            $('#mensagem').addClass(classe);
            $('#mensagem').html(mensagem).show().focus();

            setTimeout(() => {
                $('#mensagem').hide();
            }, 5000);
        }

        async function logar() {
            let email = $('#email').val();
            let password = $('#password').val();
            let _token = $('input[name="_token"]').val();

            loading(true); // ativa o loading antes da requisição

            try {
                const status = await postData("/login", {
                    "email": email,
                    "password": password,
                    "_token": _token
                });


                if (status === 200) {
                    mensagem('border-success', "Autenticado com sucesso.");
                    //location.href = "dashboard";
                } else if (status === 401) {
                    mensagem('border-warning', "Usuário e/ou senha inválidos");
                } else {
                    mensagem('border-danger', "Não foi possível realizar sua autenticação, tente novamente mais tarde");
                }

            } catch (error) {
                // Captura qualquer erro de rede ou exceção inesperada
                console.error("Erro na requisição:", error);
                mensagem('border-danger', "Erro de conexão. Tente novamente mais tarde.");
            } finally {
                console.log('chehpi finaly')
                // Sempre desativa o loading, mesmo com erro
                loading(false);
            }
        }

        async function postData(url = "", data = {}) {
            const response = await fetch(url, {
                method: "POST",
                mode: "cors",
                cache: "no-cache",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                },
                redirect: "follow",
                referrerPolicy: "no-referrer",
                body: JSON.stringify(data),
            });
            return response.status;
        }

        $(document).on("click", "#btnLogin", function() {
            logar();
        });





