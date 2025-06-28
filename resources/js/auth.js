// // resources/js/auth.js
// import { supabase } from './supabase'

// async function signUp(email, password) {
//     const { data, error } = await supabase.auth.signUp({
//         email,
//         password,
//         options: {
//             emailRedirectTo: 'http://localhost:8000/verify-email', // Redirect after verification
//         },
//     })

//     if (error) throw error
//     return data

//     async function checkAuth() {
//         const { data: { user } } = await supabase.auth.getUser()

//         if (user ? .email_confirmed_at) {
//             console.log("Email verified!")
//         } else {
//             console.log("Pending verification")
//         }
//     }

//     async function resendVerification() {
//         const { error } = await supabase.auth.resendEmailVerification()
//         if (error) throw error
//     }
// }