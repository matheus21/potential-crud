import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { FiTrash2 } from 'react-icons/fi';

import api from '../../services/api';

import './styles.css';

import logoImg from '../../assets/logo.svg';

export default function List () {
    
    function formatDate(stringDate)
    {
        const arrayDate = stringDate.split("-");
        return arrayDate[2]+ "/" + arrayDate[1] + "/" + arrayDate[0];
    }
    
    const [developers, setDevelopers] = useState([]);

    async function getDevelopers() {
        const result = await api.get('developers');
        setDevelopers(result.data.data);
    }

    getDevelopers();

    async function handleDeleteDeveloper(id) {
        try {
            await api.delete(`developers/${id}`);
        setDevelopers(developers.filter(developer => developer.id !== id));
        } catch (err) {
            alert ('Erro ao deletar desenvolvedor, tente novamente')
        }
    }

    return <div className="profile-container">
        <header>
            <img src={logoImg} alt="Desenvolvedores"/>
            <span>Desenvolvedores</span>

            <Link className="button" to="/register">Cadastrar novo desenvolvedor</Link>
        
        </header>

        <h1>Desenvolvedores cadastrados</h1>
        <ul>
            {developers.map(developer => (
                <li key={developer.id}>
                
                <strong>ID: </strong>
                <p>{developer.id}</p>

                <strong>NOME: </strong>
                <p>{developer.nome}</p>

                <strong>SEXO: </strong>
                <p>{developer.sexo}</p>
                
                <strong>IDADE: </strong>
                <p>{developer.sexo}</p>

                <strong>HOBBY: </strong>
                <p>{developer.hobby}</p>
                
                <strong>DATA NASCIMENTO: </strong>
                <p>{formatDate(developer.datanascimento)}</p>

                <Link className="button" to={`/update/${developer.id}`}>Editar</Link>

                <button onClick={() => handleDeleteDeveloper(developer.id)} type="button">
                    <FiTrash2 stize={20} color="#a8a8b3"/>
                </button>  
            </li>
            ))}
        </ul>
        
    </div>
} 