const cep = document.querySelector('#cep')
cep.addEventListener('change', () => {

	cep.value = cep.value.replace(/-/g, '')
	const url = `https://viacep.com.br/ws/${cep.value}/json/`
	fetch(url).then(async response => {
		if (response.ok) {
			await response.json().then(data => {
				if (data.logradouro != undefined) {
					const rua = document.querySelector('#rua')
					const bairro = document.querySelector('#bairro')
					const cidade = document.querySelector('#cidade')
					const uf = document.querySelector('#uf')

					rua.value = data.logradouro
					bairro.value = data.bairro
					cidade.value = data.localidade
					uf.value = data.uf

					rua.readOnly = true
					bairro.readOnly = true
					cidade.readOnly = true
					uf.readOnly = true
				} else {
					cep.value = "CEP não encontrado."
				}
			})
		} else {
			cep.value = "CEP não encontrado"
		}
	}) .catch(() => {
        cep.value = "CEP não encontrado"
    })
})