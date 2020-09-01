import React, {useState} from 'react';
import { Link, useHistory } from 'react-router-dom'
import { FiArrowLeft } from 'react-icons/fi'
import api from '../../services/api'

import './styles.css';
import logoImg from '../../assets/logo.svg';

export default function Register() {
    
    const [nome, setNome] = useState('');
    const [sexo, setSexo] = useState('');
    const [idade, setIdade] = useState('');
    const [hobby, setHobby] = useState('');
    const [datanascimento, setDatanascimento] = useState('');

    const history = useHistory();

    async function handleRegister(e) {
        e.preventDefault();

        const data = {nome, sexo, idade, hobby, datanascimento};

        try {
            await api.post('developers', data);
            alert(`Desenvolvedor cadastrado com sucesso`);

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
                    <h1>Cadastrar</h1>
                    <p>Preencha os dados do desenvolvedor:</p>

                    <Link className="back-link" to="/">
                        <FiArrowLeft size={16} color="#15aae6"/>
                        Lista de desenvolvedores
                    </Link>

                </section>
                
                <form onSubmit={handleRegister}>

                <input value={nome} onChange={e => setNome(e.target.value)} placeholder="Nome"/>
                <input value={sexo} onChange={e => setSexo(e.target.value)} placeholder="Sexo" maxLength="1"/>
                <input value={idade} onChange={e => setIdade(e.target.value)} placeholder="Idade" type="number"/>
                <input value={hobby} onChange={e => setHobby(e.target.value)} placeholder="Hobby" />
                <input value={datanascimento} onChange={e => setDatanascimento(e.target.value)} type="date"/>
                
                
                <button className="button" type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    )
}