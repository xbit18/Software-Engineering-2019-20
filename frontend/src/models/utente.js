class Utente{
    constructor(id,email,password,name,surname,birthdate,type,course,matriculation_number,identification_number	,created_at,updated_at){
        this.id = id;
        this.email = email;
        this.password = password;
        this.name = name;
        this.surname = surname;
        this.birthdate = birthdate;
        this.type = type;
        this.course = course;
        this.matriculation_number = matriculation_number;
        this.identification_number	 = identification_number	;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}

export default Utente;
