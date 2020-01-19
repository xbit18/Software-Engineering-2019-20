class Token{
    constructor(id,data_entrata,data_uscita,materia,id_utente,id_aula,created_at,updated_at){
        this.id = id;
        this.data_entrata = data_entrata;
        this.data_uscita = data_uscita;
        this.materia = materia;
        this.id_utente = id_utente;
        this.id_aula = id_aula;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}

export default Token;