class Posto{
    constructor(id,numero,disponibilita,utente,aula,created_at,updated_at){
        this.id = id;
        this.numero_posto = numero;
        this.disponibilita = disponibilita;
        this.id_utente = utente;
        this.id_aula = aula;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}

export default Posto;