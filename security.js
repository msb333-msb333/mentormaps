function createSalt(email){
    return md5(email.substring(4, 7));
}
function createSecurePassword(email, rawPassword){
    return md5(rawPassword) + createSalt(email);
}