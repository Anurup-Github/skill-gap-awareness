// api/mentors.js

import { createClient } from '@supabase/supabase-js';

const supabase = createClient(
  process.env.SUPABASE_URL,
  process.env.SUPABASE_ANON_KEY
);

export default async function handler(req, res) {
  const { goal, level, language } = req.query;

  console.log("Query received:", { goal, level, language });

  const { data, error } = await supabase
    .from('mentors')
    .select('*')
    // .ilike('expertise', goal)
    // .ilike('level', level)
    // .ilike('language', language);

  if (error) {
    console.error("Supabase error:", error);
    return res.status(500).json({ error: "Failed to fetch mentors" });
  }

  console.log("Matched mentors:", data);
  res.status(200).json({ matches: data });
}
