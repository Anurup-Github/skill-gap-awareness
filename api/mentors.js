import { createClient } from '@supabase/supabase-js';

const supabase = createClient(
  process.env.SUPABASE_URL,
  process.env.SUPABASE_ANON_KEY
);

export default async function handler(req, res) {
  const { goal, level, language } = req.query;

  console.log("Query received:", { goal, level, language });

  // Build the query with ilike and wildcards for flexible matching
  let query = supabase.from('mentors').select('*');

  if (goal) query = query.ilike('expertise', `%${goal}%`);
  if (level) query = query.ilike('level', `%${level}%`);
  if (language) query = query.ilike('language', `%${language}%`);

  const { data, error } = await query;

  if (error) {
    console.error("Supabase error:", error);
    return res.status(500).json({ error: "Failed to fetch mentors" });
  }

  console.log("Matched mentors:", data);
  res.status(200).json({ matches: data });
}
