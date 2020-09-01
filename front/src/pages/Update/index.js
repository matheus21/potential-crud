import React, {useState, useEffect} from 'react';
import { Link, useHistory, useParams } from 'react-router-dom'
import { FiArrowLeft } from 'react-icons/fi'
import api from '../../services/api'

import '../Register/styles.css';
import logoImg from '../../assets/logo.svg';

export default function Update() {
    
    const [developer, setDeveloper] = useState([]);
    const { id }  = useParams()
    
    useEffect(() => {
        api.get(`developers/${id}`).then(response => {setDeveloper(response.data.data)})
    })

    const [nome, setNome] = useState(developer.nome);
    const [sexo, setSexo] = useState(developer.sexo);
    const [idade, setIdade] = useState(developer.idade);
    const [hobby, setHobby] = useState(developer.hobby);
    const [datanascimento, setDatanascimento] = useState(developer.datanascimento);

    const history = useHistory();

    async function handleRegister(e) {
        e.preventDefault();

        const data = {nome, sexo, idade, hobby, datanascimento};

        try {
            await api.put(`developers/${id}`, data);
            alert(`Desenvolvedor alterado com sucesso`);

            history.push('/')
        } catch (err) {
            let errors = Object.values(err.response.data);
            let allErrors = "";
            errors.forEach(element => {
                allErrors += element[0] + "\n"
            });
            alert(allErrors);
        }
    }

    return (
        <div className="register-container">
            <div className="content">
                <section>
                    <img src={logoImg} alt="Desenvolvedores"/>
                    <h1>Editar</h1>
                    <p>Altere os dados do desenvolvedor:</p>

                    <Link className="back-link" to="/">
                        <FiArrowLeft size={16} color="#15aae6"/>
                        Lista de desenvolvedores
                    </Link>

                </section>
                
                <form onSubmit={handleRegister}>

                <input value={nome} onChange={e => setNome(e.target.value)} placeholder={developer.nome}/>
                <input value={sexo} onChange={e => setSexo(e.target.value)} placeholder={developer.sexo} maxLength="1" />
                <input value={idade} onChange={e => setIdade(e.target.value)} placeholder={developer.idade} type="number"/>
                <input value={hobby} onChange={e => setHobby(e.target.value)} placeholder={developer.hobby} />
                <input value={datanascimento} onChange={e => setDatanascimento(e.target.value)} type="text" placeholder={developer.datanascimento} 
                onFocus={e => e.currentTarget.type = "date"} onBlur={e => e.currentTarget.type = "text"}/>
                
                <button className="button" type="submit">Editar</button>
                </form>
            </div>
        </div>
    )
}