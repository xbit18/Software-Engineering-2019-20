class Utente{
    constructor(id,email,password,nome,cognome,data_nascita,tipo,corso,matricola,numero_documento,created_at,updated_at){
        this.id = id;
        this.email = email;
        this.password = password;
        this.nome = nome;
        this.cognome = cognome;
        this.data_nascita = data_nascita;
        this.tipo = tipo;
        this.corso = corso;
        this.matricola = matricola;
        this.numero_documento = numero_documento;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}

export default Utente;
